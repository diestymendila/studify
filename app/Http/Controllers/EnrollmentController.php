<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    
    public function enroll($courseId)
    {
        $user = auth()->user();

        
        if (!$user->isStudent()) {
            return redirect()->back()->with('error', 'Only students can enroll in courses.');
        }

        
        $course = Course::findOrFail($courseId);

        
        if (!$course->is_active) {
            return redirect()->back()->with('error', 'This course is not active and cannot be enrolled.');
        }

        
        $exists = Enrollment::where('student_id', $user->id)
                           ->where('course_id', $courseId)
                           ->exists();

        if ($exists) {
            return redirect()->route('courses.catalog')->with('info', 'You are already enrolled in this course.');
        }

        
        Enrollment::create([
            'student_id' => $user->id,
            'course_id' => $courseId,
            'enrolled_at' => now(),
        ]);

        
        return redirect()->route('courses.catalog')
                        ->with('success', "You have successfully enrolled in {$course->name}! You can now start learning.");
    }

    
    public function unenroll($courseId)
    {
        $user = auth()->user();

        
        $course = Course::findOrFail($courseId);

        
        $enrollment = Enrollment::where('student_id', $user->id)
                                ->where('course_id', $courseId)
                                ->first();

        if (!$enrollment) {
            return redirect()->route('courses.catalog')->with('error', 'You are not enrolled in this course.');
        }

        
        $enrollment->delete();

        
        return redirect()->route('courses.catalog')
                        ->with('success', "You have successfully unenrolled from {$course->name}. Your progress has been saved.");
    }
}