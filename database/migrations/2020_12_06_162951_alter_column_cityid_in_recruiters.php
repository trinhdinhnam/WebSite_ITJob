<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnCityidInRecruiters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruiters', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('CityId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruiters', function (Blueprint $table) {
            //
            $table->dropColumn('CityId');

        });
    }
}
