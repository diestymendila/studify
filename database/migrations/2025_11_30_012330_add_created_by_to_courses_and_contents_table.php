<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('teacher_id')
                  ->constrained('users')->onDelete('cascade');
        });

        
        Schema::table('contents', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('course_id')
                  ->constrained('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('contents', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });
    }
};