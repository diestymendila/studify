<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function teachingCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
            ->withTimestamps();
    }

    public function contentProgress()
    {
        return $this->hasMany(ContentProgress::class, 'student_id');
    }

    public function completedContents()
    {
        return $this->belongsToMany(Content::class, 'content_completions', 'student_id', 'content_id')
            ->withTimestamps();
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class);
    }

    public function getCourseProgress($course)
    {
        $total = $course->contents->count();

        if ($total === 0) {
            return ['completed' => 0, 'total' => 0, 'percentage' => 0];
        }

        $completed = $this->completedContents()
            ->whereIn('content_id', $course->contents->pluck('id'))
            ->count();

        return [
            'completed' => $completed,
            'total' => $total,
            'percentage' => round(($completed / $total) * 100, 2),
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}
