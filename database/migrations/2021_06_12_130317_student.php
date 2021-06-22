<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->string('studentId',15)->primary();
            $table->string('name');
            $table->boolean('gender');
            $table->date('dateOfBirth');
            $table->string('phoneNumber');
            $table->string('email');
            $table->text('address');
            $table->unsignedBigInteger('classId');
            $table->boolean('studentStatus');
            $table->foreign('classId')->references('classId')->on('class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
