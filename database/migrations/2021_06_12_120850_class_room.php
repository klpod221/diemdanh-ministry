<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClassRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->id('classId');
            $table->string('className');
            $table->string('majorId',15);
            $table->unsignedBigInteger('courseId');
            $table->boolean('classStatus');
            $table->foreign('majorId')->references('majorId')->on('major');
            $table->foreign('courseId')->references('courseId')->on('course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class');
    }
}
