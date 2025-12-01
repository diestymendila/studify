<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Content;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Teachers
        $teacher1 = User::create([
            'name' => 'John Teacher',
            'email' => 'teacher1@gmail.com',
            'password' => 'teacher123',
            'role' => 'teacher',
            'is_active' => true,
        ]);

        $teacher2 = User::create([
            'name' => 'Jane Teacher',
            'email' => 'teacher2@gmail.com',
            'password' => 'teacher456',
            'role' => 'teacher',
            'is_active' => true,
        ]);

        // Create Students
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Student $i",
                'email' => "student$i@gmail.com",
                'password' => Hash::make('password'),
                'role' => 'student',
                'is_active' => true,
            ]);
        }

        // Create Categories
        $categories = [
            ['name' => 'Web Development', 'description' => 'Learn web development'],
            ['name' => 'Data Science', 'description' => 'Master data science'],
            ['name' => 'Mobile Development', 'description' => 'Build mobile apps'],
            ['name' => 'Teknologi', 'description' => 'Technology courses'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Courses
        $course1 = Course::create([
            'name' => 'Laravel Complete Course',
            'description' => 'Learn Laravel from scratch to advanced',
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'teacher_id' => $teacher1->id,
            'category_id' => 1,
            'is_active' => true,
        ]);

        $course2 = Course::create([
            'name' => 'Python for Data Science',
            'description' => 'Master Python for data analysis',
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'teacher_id' => $teacher2->id,
            'category_id' => 2,
            'is_active' => true,
        ]);

        // Create Contents for Course 1
        Content::create([
            'course_id' => $course1->id,
            'title' => 'Introduction to Laravel',
            'body' => 'Welcome to Laravel course. In this lesson, you will learn the basics of Laravel framework.',
            'order' => 1,
        ]);

        Content::create([
            'course_id' => $course1->id,
            'title' => 'Laravel Routing',
            'body' => 'Learn about routing in Laravel and how to create routes for your application.',
            'order' => 2,
        ]);

        Content::create([
            'course_id' => $course1->id,
            'title' => 'Laravel Controllers',
            'body' => 'Understanding controllers and how they handle requests in Laravel.',
            'order' => 3,
        ]);

        // Create Contents for Course 2
        Content::create([
            'course_id' => $course2->id,
            'title' => 'Python Basics',
            'body' => 'Learn the fundamentals of Python programming language.',
            'order' => 1,
        ]);

        Content::create([
            'course_id' => $course2->id,
            'title' => 'Data Analysis with Pandas',
            'body' => 'Explore data analysis using Pandas library in Python.',
            'order' => 2,
        ]);
    }
}
