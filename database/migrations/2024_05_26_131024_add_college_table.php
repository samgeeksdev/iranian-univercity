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
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        DB::table('colleges')->insert([
            'name'=>'aadad'
        
        ]);
        
        Schema::table('classrooms', function (Blueprint $table) {
            $table->bigInteger('colleges_id')->unsigned()->index()->nullable();
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
        });
        Schema::table('classroom_location_term', function (Blueprint $table) {
            $table->bigInteger('colleges_id')->unsigned()->index()->nullable();
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
        });
        Schema::table('educational_groups', function (Blueprint $table) {
            $table->bigInteger('colleges_id')->unsigned()->index()->nullable();
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->bigInteger('colleges_id')->unsigned()->index()->nullable();
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->bigInteger('colleges_id')->unsigned()->index()->nullable();
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
        });
        Schema::table('professors', function (Blueprint $table) {
            $table->bigInteger('colleges_id')->unsigned()->index()->nullable();
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('colleges_id')->unsigned()->index()->nullable();
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
