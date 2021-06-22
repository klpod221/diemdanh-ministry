<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Diemdanhstatusview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE diemDanhStatusView(IN DiemDanhId INT,IN ClassId VARCHAR(15),IN SubjectId VARCHAR(15))
            BEGIN
                SELECT date,diemDanhDetail.studentId,name,diemDanh.classId,diemDanh.subjectId,subjectName,diemDanhStatus.status FROM DiemDanhDetail
                INNER JOIN DiemDanh ON DiemDanhDetail.DiemDanhId = DiemDanh.DiemDanhId
                INNER JOIN Subject ON DiemDanh.SubjectId = Subject.SubjectId
                INNER JOIN DiemDanhStatus ON DiemDanhDetail.DiemDanh = DiemDanhStatus.DiemDanh
                INNER JOIN Student ON DiemDanhDetail.StudentId = Student.StudentId
                WHERE DiemDanh.DiemDanhId = @DiemDanhId AND DiemDanh.ClassId = @ClassId AND DiemDanh.SubjectId = @SubjectId;
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCUDURE IF EXISTS diemDanhStatusView');
    }
}
