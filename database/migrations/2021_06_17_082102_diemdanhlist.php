<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Diemdanhlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE VIEW DiemDanhList
            AS
                SELECT diemDanhDetail.studentId,name,diemDanh.classId,diemDanh.subjectId,subjectName,diemDanh FROM DiemDanhDetail
                INNER JOIN Student ON DiemDanhDetail.StudentId = Student.StudentId
                INNER JOIN DiemDanh ON DiemDanhDetail.DiemDanhId = DiemDanh.DiemDanhId
                INNER JOIN Subject ON DiemDanh.SubjectId = Subject.SubjectId
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS DiemDanhList');
    }
}
