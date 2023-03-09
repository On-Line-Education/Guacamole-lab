<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->references('id')->on('users');
            $table->foreignId('class_room_id')->references('id')->on('class_rooms');
            $table->foreignId('class_id')->references('id')->on('student_classes');
            $table->timestamp('start')->default('now');
            $table->timestamp('end');
            $table->boolean('started')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectures');
    }
};
