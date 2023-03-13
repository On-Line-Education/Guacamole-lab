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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_room_id')->references('id')->on('class_rooms');
            $table->foreignId('user_id')->nullable()->default(null)->references('id')->on('users');
            $table->string('name');
            $table->string('ip');
            $table->string('mac');
            $table->string('login');
            $table->boolean('instructor')->default(false);
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
        Schema::dropIfExists('computers');
    }
};
