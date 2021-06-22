<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Classlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE VIEW ClassList
            AS
                SELECT classId,className,majorName,courseId AS course FROM Class
                INNER JOIN Major ON Class.MajorId = Major.MajorId
                WHERE classStatus = 0 AND majorStatus = 0
                ORDER BY courseId DESC
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS classlist');
    }
}
