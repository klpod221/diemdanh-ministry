<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiemDanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem_danh', function (Blueprint $table) {
            $table->id('diem_danhId');
            $table->date('date');
            $table->unsignedBigInteger('classId');
            $table->string('subjectId',15);
            $table->time('timeStart');
            $table->time('timeEnd');
            $table->foreign('classId')->references('classId')->on('class');
            $table->foreign('subjectId')->references('subjectId')->on('subject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diemDanh');
    }
}
