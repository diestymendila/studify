<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $stats = [
                'total_users' => User::count(),
                'total_courses' => Course::count(),
                'total_teachers' => User::where('role', 'teacher')->count(),
                'total_students' => User::where('role', 'student')->count(),
            ];
            return view('dashboard.admin', compact('stats'));
        }

        if ($user->isTeacher()) {
            $courses = $user->teachingCourses()->withCount('students')->get();
            return view('dashboard.teacher', compact('courses'));
        }

        if ($user->isStudent()) {
            $enrolledCourses = $user->enrolledCourses()->with(['teacher', 'contents'])->get();
            
            $coursesWithProgress = $enrolledCourses->map(function ($course) use ($user) {
                
                $progressData = $user->getCourseProgress($course);
                
                
                $course->progress = $progressData['percentage'];
                $course->completed_contents = $progressData['completed'];
                $course->total_contents = $progressData['total'];
                
                return $course;
            });

            return view('dashboard.student', compact('coursesWithProgress'));
        }

        abort(403);
    }
}