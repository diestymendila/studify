<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    public function catalog()
    {
        $courses = Course::with(['teacher', 'category'])
                        ->where('is_active', true)
                        ->orderBy('created_at', 'desc')
                        ->paginate(12);
        
        return view('courses.catalog', compact('courses'));
    }

    
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            
            $courses = Course::with(['teacher', 'category', 'creator'])
                ->withCount('students')
                ->paginate(10);
            
            
            $totalCourses = Course::count();
        } else {
            
            $courses = $user->teachingCourses()
                ->with(['category', 'creator'])
                ->withCount('students')
                ->paginate(10);
            
            
            $totalCourses = $user->teachingCourses()->count();
        }

        return view('courses.index', compact('courses', 'totalCourses'));
    }

    
    public function create()
    {
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->where('is_active', true)->get();
        
        return view('courses.create', compact('categories', 'teachers'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:users,id',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['created_by'] = auth()->id();

        Course::create($validated);

        return redirect()->route('courses.index')
                        ->with('success', 'Course created successfully.');
    }

    
    public function show(Course $course)
    {
        $course->load(['teacher', 'category', 'contents', 'students', 'creator']);
        
        return view('courses.show', compact('course'));
    }

    
    public function edit(Course $course)
    {
        $user = auth()->user();

        
        if (!$user->isAdmin() && $course->teacher_id !== $user->id && $course->created_by !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->where('is_active', true)->get();

        return view('courses.edit', compact('course', 'categories', 'teachers'));
    }

    
    public function update(Request $request, Course $course)
    {
        $user = auth()->user();

        
        if (!$user->isAdmin() && $course->teacher_id !== $user->id && $course->created_by !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:users,id',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $course->update($validated);

        return redirect()->route('courses.index')
                        ->with('success', 'Course updated successfully.');
    }

    
    public function destroy(Course $course)
    {
        $user = auth()->user();

        
        if ($user->isAdmin()) {
            $course->delete();
            return redirect()->route('courses.index')
                    ->with('success', 'Course deleted successfully.');
        }

        
        if ($course->created_by !== $user->id) {
            return redirect()->route('courses.index')
                ->with('error', 'You can only delete courses that you created yourself.');
        }

        $course->delete();

        return redirect()->route('courses.index')
                ->with('success', 'Course deleted successfully.');
    }
}