<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = auth()->user();

        if ($user->isStudent()) {
            $enrolledCourses = $user->enrolledCourses()
                ->with(['teacher', 'contents'])
                ->get();
            
            $coursesWithProgress = $enrolledCourses->map(function ($course) use ($user) {
                $progressData = $user->getCourseProgress($course);

                $course->progress = $progressData['percentage'];
                $course->completed_contents = $progressData['completed'];
                $course->total_contents = $progressData['total'];
                
                return $course;
            });

            return view('profile.show', compact('user', 'coursesWithProgress'));
        }

        if ($user->isTeacher()) {
            $courses = $user->teachingCourses()
                ->withCount('students')
                ->with(['students' => function($query) {
                    $query->select('users.id', 'users.name');
                }])
                ->get()
                ->map(function($course) {
                    // Hitung average progress dari semua student yang enrolled
                    if ($course->students->count() > 0) {
                        $totalProgress = 0;
                        
                        foreach ($course->students as $student) {
                            $progressData = $student->getCourseProgress($course);
                            $totalProgress += $progressData['percentage'];
                        }
                        
                        $course->average_progress = $totalProgress / $course->students->count();
                    } else {
                        $course->average_progress = 0;
                    }
                    
                    return $course;
                });
                
            return view('profile.show', compact('user', 'courses'));
        }

        return view('profile.show', compact('user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}