<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Assignmentlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE VIEW assignmentlist
            AS
                SELECT assignmentId,name,email,phoneNumber,classId,assignment.subjectId,subjectName FROM assignment
                INNER JOIN teacher ON assignment.teacherId = teacher.teacherId
                INNER JOIN subject ON assignment.subjectId = subject.subjectId
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS assignmentlist');
    }
}
