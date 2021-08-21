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
            CREATE VIEW classlist
            AS
                SELECT classId,className,majorName,courseId AS course FROM class
                INNER JOIN major ON class.majorId = major.majorId
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
