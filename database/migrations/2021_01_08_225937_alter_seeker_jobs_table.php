<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSeekerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('seeker_jobs', function (Blueprint $table) {
            //
            $table->string('SeekerEmail');
            $table->string('SeekerPhone');
            $table->string('SeekerAddress');
            $table->string('SeekerAvatar');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('seeker_jobs', function (Blueprint $table) {
            //
            $table->string('SeekerEmail');
            $table->string('SeekerPhone');
            $table->string('SeekerAddress');
            $table->string('SeekerAvatar');
        });
    }
}
