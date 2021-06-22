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
            CREATE VIEW StudentList
            AS
                SELECT studentId,name,gender,dateOfBirth,phoneNumber,email,className,majorName,courseId AS course,address FROM Student
                INNER JOIN Class ON Student.ClassId = Class.ClassId
                INNER JOIN Major ON Class.MajorId = Major.MajorId
                WHERE Major.majorStatus = 0 AND Class.classStatus = 0 AND studentStatus = 0
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS StudentList');
    }
}
