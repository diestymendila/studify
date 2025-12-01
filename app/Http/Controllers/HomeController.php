<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $categories = Category::orderBy('name')->get();

        
        $popularCourses = collect();

        if (! $request->filled('search') && ! $request->filled('category')) {
            $popularCourses = Course::with(['category', 'teacher'])
                ->withCount('students')
                ->orderBy('students_count', 'desc')
                ->limit(6)
                ->get()
                ->map(function ($course) {
                    $course->student_count = $course->students_count ?? 0;

                    return $course;
                });
        }

        
        $coursesQuery = Course::with(['category', 'teacher'])
            ->withCount('students');

        
        if ($request->filled('category')) {
            $coursesQuery->where('category_id', $request->category);
        }

        
        if ($request->filled('search')) {
            $search = trim($request->search);
            $coursesQuery->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(name) like ?', ['%'.strtolower($search).'%'])
                    ->orWhereRaw('LOWER(description) like ?', ['%'.strtolower($search).'%']);
            });
        }

        
        $courses = $coursesQuery->orderBy('created_at', 'desc')
            ->paginate(9)
            ->through(function ($course) {
                $course->student_count = $course->students_count ?? 0;

                return $course;
            });

        return view('home', compact('courses', 'popularCourses', 'categories'));
    }

    public function courseDetail($id)
    {
        
        $course = Course::with(['category', 'teacher', 'contents'])
            ->withCount('students')
            ->findOrFail($id);

        
        $course->student_count = $course->students_count ?? 0;

        
        $isEnrolled = false;
        $progress = 0;

        
        if (auth()->check()) {
            
            if (isset(auth()->user()->role) && auth()->user()->role === 'student') {
                // Cek enrollment dari database
                $isEnrolled = \DB::table('enrollments')
                    ->where('course_id', $course->id)
                    ->where('student_id', auth()->id())
                    ->exists();

                
                if ($isEnrolled && $course->contents->count() > 0) {
                    $totalContents = $course->contents->count();

                    
                    if (\Schema::hasTable('content_completions')) {
                        $completedContents = \DB::table('content_completions')
                            ->whereIn('content_id', $course->contents->pluck('id'))
                            ->where('user_id', auth()->id())
                            ->count();

                        $progress = ($completedContents / $totalContents) * 100;
                    }
                }
            }
        }

        return view('courses.detail', compact('course', 'isEnrolled', 'progress'));
    }
}
