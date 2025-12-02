<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = auth()->user();

        if ($user->isStudent()) {
            if (!$user->enrolledCourses()->where('course_id', $courseId)->exists()) {
                abort(403, 'You must enroll in this course to access discussions.');
            }
        } elseif ($user->isTeacher()) {
            if ($course->teacher_id !== $user->id) {
                abort(403, 'You can only access discussions for your courses.');
            }
        }

        $discussions = Discussion::where('course_id', $courseId)
            ->with([
                'user',
                'replies.user' => fn ($q) => $q->orderBy('created_at', 'asc')
            ])
            ->latest()
            ->paginate(10);

        return view('discussions.index', compact('course', 'discussions'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('discussions.create', compact('course'));
    }

    public function store(Request $request, $courseId)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $validated['course_id'] = $courseId;
        $validated['user_id'] = auth()->id();

        Discussion::create($validated);

        return redirect()
            ->route('discussions.index', $courseId)
            ->with('success', 'Discussion created successfully.');
    }

    public function show($courseId, Discussion $discussion)
    {
        abort(404);
    }

    public function reply(Request $request, $courseId, Discussion $discussion)
    {
        $request->validate([
            'body' => 'required|string|max:5000',
        ]);

        DiscussionReply::create([
            'discussion_id' => $discussion->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect()
            ->route('discussions.index', $courseId)
            ->with('success', 'Reply added successfully.');
    }

    public function destroy($courseId, Discussion $discussion)
    {
    // hanya pemilik diskusi, teacher, atau admin
    if (
        auth()->id() !== $discussion->user_id &&
        !auth()->user()->isTeacher() &&
        !auth()->user()->isAdmin()
    ) {
        abort(403);
    }

    
    $discussion->replies()->delete();

    
    $discussion->delete();

    return redirect()->route('discussions.index', $courseId)
        ->with('success', 'Discussion deleted successfully.');
    }


    public function destroyReply($courseId, Discussion $discussion, DiscussionReply $reply)
    {
    
    if ($reply->discussion_id != $discussion->id) {
        abort(404);
    }

    
    if (
        auth()->id() !== $reply->user_id &&
        !auth()->user()->isTeacher() &&
        !auth()->user()->isAdmin()
    ) {
        abort(403);
    }

    $reply->delete();

    return redirect()->back()->with('success', 'Reply deleted successfully.');
    }
}

