<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_details', function (Blueprint $table) {
            $table->id('actDetails_id');
            $table->integer('score')->nullable();
            $table->integer('tries')->nullable();
            $table->float('time_to_complete')->nullable();
            $table->integer('keystrokes_recorded')->nullable();
            $table->float('keystroke_rate')->nullable();
            $table->float('conc_level')->nullable();
        });

        Schema::table('activity_details', function (Blueprint $table) {
            $table->unsignedBigInteger('activiy_id');
            $table->foreign('activiy_id')->references('act_id')->on('activities')->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('stu_id')->on('student_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_details');
    }
}
