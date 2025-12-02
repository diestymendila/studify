<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show($courseId, $contentId = null)
    {
        $user = auth()->user();

        
        $course = Course::with(['contents' => function ($q) {
            $q->orderBy('order', 'asc');
        }, 'teacher', 'students'])->findOrFail($courseId);


        if ($user->isTeacher() && $course->teacher_id === $user->id) {
            $students = $course->students;
            $studentsProgress = $students->map(function ($student) use ($course) {
                $total = $course->contents->count();
                $completed = $course->contents->filter(
                    fn($c) => $c->isCompletedBy($student->id)
                )->count();

                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'completed_contents' => $completed,
                    'total_contents' => $total,
                    'progress' => $total > 0 ? round(($completed / $total) * 100, 2) : 0,
                ];
            });

            return view('lessons.teacher-view', compact('course', 'studentsProgress'));
        }


        if (!$user->isStudent()) {
            abort(403, 'Access denied.');
        }

        
        if (!$user->enrolledCourses()->where('course_id', $courseId)->exists()) {
            return redirect()
                ->route('course.detail', $courseId)
                ->with('error', 'You must enroll in this course first.');
        }

        
        if (!$contentId) {
            $first = $course->contents->first();
            if (!$first) {
                return redirect()->route('dashboard')
                    ->with('error', 'This course has no content yet.');
            }
            return redirect()->route('lesson.show', [
                'course' => $courseId,
                'content' => $first->id,
            ]);
        }

        
        $content = Content::where('course_id', $courseId)
            ->where('id', $contentId)
            ->firstOrFail();


        $previousLessons = $course->contents->filter(
            fn($item) => $item->order < $content->order
        );

        $locked = false;
        $lockedLesson = null;
        
        
        foreach ($previousLessons as $prev) {
            if (!$prev->isCompletedBy($user->id)) {
                $locked = true;
                $lockedLesson = $prev;
                break; 
            }
        }

        
        if ($locked) {
            return redirect()->route('lesson.show', [
                'course' => $courseId,
                'content' => $lockedLesson->id,
            ])->with('error', 'You must complete the previous lesson first.');
        }

        
        $contents = $course->contents->map(function ($item) use ($user) {
            $item->is_completed = $item->isCompletedBy($user->id);
            return $item;
        })->values(); 

        $isCompleted = $content->isCompletedBy($user->id);

        
        $currentIndex = $contents->search(fn($item) => $item->id === $content->id);

        
        $previousContent = $contents->get($currentIndex - 1);
        
        
        $nextContent = $contents->get($currentIndex + 1);
        

        
        $nextLocked = false;
        if ($nextContent && !$isCompleted) {
            $nextLocked = true;
        }

        return view('lessons.show', compact(
            'course',
            'content',
            'contents',
            'isCompleted',
            'nextContent',
            'previousContent',
            'nextLocked'
        ));
    }


    public function markAsComplete($courseId, $contentId)
    {
        $user = auth()->user();

        if (!$user->isStudent()) {
            abort(403, 'Only students can mark content as complete.');
        }

        $course = Course::with(['contents' => fn($q) => $q->orderBy('order')])
            ->findOrFail($courseId);

        if (!$user->enrolledCourses()->where('course_id', $courseId)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        $content = Content::where('course_id', $courseId)
            ->where('id', $contentId)
            ->firstOrFail();

        
        $previousLessons = $course->contents->filter(
            fn($item) => $item->order < $content->order
        );

        foreach ($previousLessons as $prev) {
            if (!$prev->isCompletedBy($user->id)) {
                return redirect()->route('lesson.show', [
                    'course' => $courseId,
                    'content' => $prev->id
                ])->with('error', 'You must complete the previous lesson first.');
            }
        }

        
        if ($content->isCompletedBy($user->id)) {
            $content->markAsIncompleteBy($user->id);
            $msg = 'Completion removed!';
        } else {
            $content->markAsCompletedBy($user->id);
            $msg = 'Content marked as complete!';
        }

        
        $nextContent = $course->contents
            ->where('order', '>', $content->order)
            ->sortBy('order')
            ->first();

        if ($nextContent) {
            return redirect()->route('lesson.show', [
                'course' => $courseId,
                'content' => $nextContent->id
            ])->with('success', $msg);
        }

        return redirect()->back()->with('success', $msg);
    }
}