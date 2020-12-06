<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForeignKeyCityidInRecruiters extends Migration
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
            $table->foreign('CityId')
            ->references('CityId')
            ->on('cities')
            ->onDelete('cascade');
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

            $table->dropForeign('CityId');
        });
    }
}
