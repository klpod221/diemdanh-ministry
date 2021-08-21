<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiemDanhDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem_danh_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('diem_danhId');
            $table->string('studentId',15);
            $table->float('diem_danh');
            $table->primary(['diem_danhId','studentId']);
            $table->foreign('diem_danhId')->references('diem_danhId')->on('diem_danh');
            $table->foreign('studentId')->references('studentId')->on('student');
            $table->foreign('diem_danh')->references('diem_danh')->on('diem_danh_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
