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
        Schema::table('classrooms', function (Blueprint $table) {

            if (!Schema::hasColumn('classrooms', 'lesson_id')) {
                $table->unsignedBigInteger('lesson_id')->nullable();
                $table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('cascade')->onDelete('cascade');
            }

            if (!Schema::hasColumn('classrooms', 'professor_id')) {
                $table->unsignedBigInteger('professor_id')->nullable();
                $table->foreign('professor_id')->references('id')->on('professors')->onUpdate('cascade')->onDelete('cascade');
            }

            if (!Schema::hasColumn('classrooms', 'week_day')) {
                $table->enum('week_day', ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه'])->nullable();
            }

            if (!Schema::hasColumn('classrooms', 'time_period_id')) {
                $table->unsignedBigInteger('time_period_id')->nullable();
                $table->foreign('time_period_id')->references('id')->on('time_periods')->onUpdate('cascade')->onDelete('cascade');
            }

            if (!Schema::hasColumn('classrooms', 'status')) {
                $table->enum('status', ['ثابت', 'چرخشی'])->nullable();
            }

            if (!Schema::hasColumn('classrooms', 'eg_id')) {
                $table->unsignedBigInteger('eg_id')->nullable();
                $table->foreign('eg_id')->references('id')->on('educational_groups')->onUpdate('cascade')->onDelete('cascade');
            }

            if (!Schema::hasColumn('classrooms', 'entry_id')) {
                $table->unsignedBigInteger('entry_id')->nullable();
                $table->foreign('entry_id')->references('id')->on('entries')->onUpdate('cascade')->onDelete('cascade');
            }

            if (!Schema::hasColumns('classrooms', ['created_at', 'updated_at'])) {
                $table->timestamps();
            }
           // $table->unsignedBigInteger('college_id')->nullable(); // Ensure this is correct

        });
        
     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            if (Schema::hasColumn('classrooms', 'lesson_id')) {
                $table->dropForeign(['lesson_id']);
                $table->dropColumn('lesson_id');
            }

            if (Schema::hasColumn('classrooms', 'professor_id')) {
                $table->dropForeign(['professor_id']);
                $table->dropColumn('professor_id');
            }

            if (Schema::hasColumn('classrooms', 'week_day')) {
                $table->dropColumn('week_day');
            }

            if (Schema::hasColumn('classrooms', 'time_period_id')) {
                $table->dropForeign(['time_period_id']);
                $table->dropColumn('time_period_id');
            }

            if (Schema::hasColumn('classrooms', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('classrooms', 'eg_id')) {
                $table->dropForeign(['eg_id']);
                $table->dropColumn('eg_id');
            }

            if (Schema::hasColumn('classrooms', 'entry_id')) {
                $table->dropForeign(['entry_id']);
                $table->dropColumn('entry_id');
            }

            if (Schema::hasColumns('classrooms', ['created_at', 'updated_at'])) {
                $table->dropTimestamps();
            }
        });
    }
};