<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    
    public function index($courseId)
    {
        $course = Course::with(['contents.creator'])->findOrFail($courseId);
        
        // Pastikan user memiliki akses ke course ini
        $user = auth()->user();
        if (!$user->isAdmin() && $course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('contents.index', compact('course'));
    }

    
    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        
        
        $user = auth()->user();
        if (!$user->isAdmin() && $course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('contents.create', compact('course'));
    }

    
    public function store(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        
        
        $user = auth()->user();
        if (!$user->isAdmin() && $course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'order' => 'required|integer|min:1',
        ]);

        $validated['course_id'] = $courseId;
        $validated['created_by'] = auth()->id();

        Content::create($validated);

        return redirect()->route('contents.index', $courseId)
                        ->with('success', 'Content created successfully.');
    }

    
    public function edit($courseId, $contentId)
    {
        $course = Course::findOrFail($courseId);
        $content = Content::findOrFail($contentId);
        
        
        $user = auth()->user();
        if (!$user->isAdmin() && $course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('contents.edit', compact('course', 'content'));
    }

    
    public function update(Request $request, $courseId, $contentId)
    {
        $course = Course::findOrFail($courseId);
        $content = Content::findOrFail($contentId);
        
        
        $user = auth()->user();
        if (!$user->isAdmin() && $course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'order' => 'required|integer|min:1',
        ]);

        $content->update($validated);

        return redirect()->route('contents.index', $courseId)
                        ->with('success', 'Content updated successfully.');
    }

    
    public function destroy($courseId, $contentId)
    {
        $course = Course::findOrFail($courseId);
        $content = Content::findOrFail($contentId);
        
        $user = auth()->user();

        
        if ($user->isAdmin()) {
            $content->delete();
            return redirect()->route('contents.index', $courseId)
                    ->with('success', 'Content deleted successfully.');
        }

        
        if ($content->created_by !== $user->id) {
            return redirect()->route('contents.index', $courseId)
                ->with('error', 'You can only delete content that you created yourself.');
        }

        $content->delete();

        return redirect()->route('contents.index', $courseId)
                ->with('success', 'Content deleted successfully.');
    }
}