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
        Schema::create('diemDanhDetail', function (Blueprint $table) {
            $table->unsignedBigInteger('diemDanhId');
            $table->string('studentId',15);
            $table->float('diemDanh');
            $table->primary(['diemDanhId','studentId']);
            $table->foreign('diemDanhId')->references('diemDanhId')->on('diemDanh');
            $table->foreign('studentId')->references('studentId')->on('student');
            $table->foreign('diemDanh')->references('diemDanh')->on('diemDanhStatus');
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
