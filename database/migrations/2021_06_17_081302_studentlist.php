<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Studentlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE VIEW studentlist
            AS
                SELECT studentId,name,gender,dateOfBirth,phoneNumber,email,className,majorName,courseId AS course,address FROM student
                INNER JOIN class ON student.classId = class.classId
                INNER JOIN major ON class.majorId = major.majorId
                WHERE major.majorStatus = 0 AND class.classStatus = 0 AND studentStatus = 0
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS studentlist');
    }
}
