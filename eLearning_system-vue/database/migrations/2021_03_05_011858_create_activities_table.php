<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id('act_id');
            $table->string('act_name', 100);
            $table->longText('act_desc');
            $table->string('act_difficulty', 45);
            $table->longText('correct_answer');
            $table->longText('act_question');
            $table->longText('act_script')->nullable();
            $table->longText('act_images')->nullable();
            $table->integer('act_min_keystrokes');
            $table->boolean('validated')->nullable();
            $table->integer('created_by_id');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_id');
            $table->foreign('lesson_id')->references('les_id')->on('lessons')->onDelete('cascade');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('prog_id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
