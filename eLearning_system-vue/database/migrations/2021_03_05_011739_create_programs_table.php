<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id('prog_id');
            $table->string('prog_name', 100);
            $table->longText('prog_desc');
            $table->string('prog_type', 45);
            $table->string('prog_difficulty', 45);
            $table->boolean('validated')->nullable();

            $table->integer('created_by_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
