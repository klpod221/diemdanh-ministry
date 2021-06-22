<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment', function (Blueprint $table) {
            $table->id('assignmentId');
            $table->unsignedBigInteger('classId');
            $table->string('subjectId',15);
            $table->unsignedBigInteger('teacherId');
            $table->foreign('classId')->references('classId')->on('class');
            $table->foreign('subjectId')->references('subjectId')->on('subject');
            $table->foreign('teacherId')->references('teacherId')->on('teacher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment');
    }
}
