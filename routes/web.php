<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/course/{id}', [HomeController::class, 'courseDetail'])->name('course.detail');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* PROFILE */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

        Route::get('/course/{course}/progress', [ProfileController::class, 'showCourseProgress'])
            ->name('course.progress')
            ->middleware('role:teacher,admin');
    });

    /* PUBLIC COURSE CATALOG */
    Route::get('/courses/catalog', [CourseController::class, 'catalog'])->name('courses.catalog');

    /* ========== LESSON ROUTES - SHARED (Student & Teacher) ========== */
    // Route ini bisa diakses oleh Student DAN Teacher
    // Controller akan auto-detect role dan menampilkan view yang sesuai
    Route::get('/courses/{course}/lessons/{content?}', [LessonController::class, 'show'])
    ->name('lesson.show');


    /* STUDENT ROUTES */
    Route::middleware(['role:student'])->group(function () {
        // Enrollment
        Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('course.enroll');
        Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'unenroll'])->name('course.unenroll');

        // Mark as complete - hanya untuk student
        Route::post('/courses/{courseId}/contents/{contentId}/complete', [LessonController::class, 'markAsComplete'])
            ->name('content.complete');

        // Alternative Content Routes (jika masih digunakan)
        Route::get('/courses/{course}/learn/{content}', [ContentController::class, 'show'])->name('contents.show');
        Route::post('/courses/{course}/contents/{content}/mark-complete', [ContentController::class, 'markAsCompleted'])->name('contents.complete');
        Route::post('/courses/{course}/contents/{content}/mark-incomplete', [ContentController::class, 'markAsIncomplete'])->name('contents.incomplete');
    });

    /* TEACHER + ADMIN ROUTES */
    Route::middleware(['role:teacher,admin'])->group(function () {
        // Course Management
        Route::resource('courses', CourseController::class);

        // Content Management
        Route::prefix('courses/{course}/contents')->name('contents.')->group(function () {
            Route::get('/', [ContentController::class, 'index'])->name('index');
            Route::get('/create', [ContentController::class, 'create'])->name('create');
            Route::post('/', [ContentController::class, 'store'])->name('store');
            Route::get('/{content}/edit', [ContentController::class, 'edit'])->name('edit');
            Route::put('/{content}', [ContentController::class, 'update'])->name('update');
            Route::delete('/{content}', [ContentController::class, 'destroy'])->name('destroy');
        });
    });

    /* DISCUSSION ROUTES */
    Route::middleware(['role:student,teacher'])
        ->prefix('courses/{course}/discussions')
        ->name('discussions.')
        ->group(function () {
            Route::get('/', [DiscussionController::class, 'index'])->name('index');
            Route::post('/', [DiscussionController::class, 'store'])->name('store');
            Route::post('/{discussion}/replies', [DiscussionController::class, 'reply'])->name('reply');
            Route::delete('/{discussion}/replies/{reply}', [DiscussionController::class, 'destroyReply'])->name('reply.destroy');
            Route::delete('/{discussion}', [DiscussionController::class, 'destroy'])->name('destroy');
        });

    /* ADMIN ROUTES */
    Route::middleware(['role:admin'])
        ->prefix('admin')->name('admin.')
        ->group(function () {
            Route::resource('users', UserController::class);
            Route::resource('categories', CategoryController::class);
        });

});