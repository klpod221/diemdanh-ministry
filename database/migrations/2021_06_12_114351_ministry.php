<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ministry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry', function (Blueprint $table) {
            $table->id('ministryId');
            $table->string('name');
            $table->boolean('gender');
            $table->date('dateOfBirth');
            $table->string('email')->unique();
            $table->string('phoneNumber',15)->unique();
            $table->string('passWord');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ministry');
    }
}
