<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'body',
        'order',
        'created_by',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function completions()
    {
        return $this->hasMany(ContentCompletion::class, 'content_id');
    }

    public function completedByUsers()
    {
        return $this->belongsToMany(User::class, 'content_completions', 'content_id', 'student_id')
            ->withTimestamps();
    }

    public function isCompletedBy($userId)
    {
        return $this->completedByUsers()->where('student_id', $userId)->exists();
    }

    public function markAsCompletedBy($userId)
    {
        $this->completedByUsers()->syncWithoutDetaching([$userId]);
    }

    public function markAsIncompleteBy($userId)
    {
        $this->completedByUsers()->detach($userId);
    }

    public function getCompletionPercentage()
    {
        $totalStudents = $this->course->students()->count();

        if ($totalStudents === 0) {
            return 0;
        }

        $completedCount = $this->completedByUsers()->count();

        return round(($completedCount / $totalStudents) * 100, 2);
    }
}
