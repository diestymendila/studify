<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('content_completions', function (Blueprint $table) {
            $table->id();

            // student id (from users table)
            $table->foreignId('student_id')
                ->constrained('users')
                ->onDelete('cascade');

            // lesson/content id
            $table->foreignId('content_id')
                ->constrained('contents')
                ->onDelete('cascade');

            $table->timestamps();

            // prevent duplicate completion entries
            $table->unique(['student_id', 'content_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_completions');
    }
};
