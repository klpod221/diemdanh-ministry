<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Thongkediemdanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE thongKeDiemDanh(IN ClassId VARCHAR(15),IN SubjectId VARCHAR(15))
            BEGIN
                SELECT studentId,classId,name,subjectId,subjectName,SUM(DiemDanh) AS siemDanh FROM DiemDanhList
                WHERE ClassId = @ClassId AND SubjectId = @SubjectId
                GROUP BY StudentId,ClassId,SubjectId,Name,SubjectName;
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
        DB::unprepared('DROP PROCUDURE IF EXISTS thongKeDiemDanh');
    }
}
