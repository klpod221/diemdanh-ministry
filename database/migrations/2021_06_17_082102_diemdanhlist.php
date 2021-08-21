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
            CREATE VIEW diem_danh_list
            AS
                SELECT diem_danh_detail.studentId,name,diem_danh.classId,diem_danh.subjectId,subjectName,diem_danh FROM diem_danh_detail
                INNER JOIN student ON diem_danh_detail.studentId = student.studentId
                INNER JOIN diem_danh ON diem_danh_detail.diem_danhId = diem_danh.diem_danhId
                INNER JOIN subject ON diem_danh.subjectId = subject.subjectId
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS diem_danh_list');
    }
}
