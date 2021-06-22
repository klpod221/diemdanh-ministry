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
            CREATE VIEW AssignmentList
            AS
                SELECT assignmentId,name,email,phoneNumber,classId,assignment.subjectId,subjectName FROM Assignment
                INNER JOIN Teacher ON Assignment.TeacherId = Teacher.TeacherId
                INNER JOIN Subject ON Assignment.SubjectId = Subject.SubjectId
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS AssignmentList');
    }
}
