<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeker_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('SeekerId');
            $table->unsignedBigInteger('JobId');
            $table->string('CVLink')->nullable();
            $table->tinyInteger('Status')->index()->default(1);
            $table->foreign('SeekerId')
            ->references('id')
            ->on('seekers')
            ->onDelete('cascade');
            $table->foreign('JobId')
            ->references('JobId')
            ->on('jobs')
            ->onDelete('cascade');
            $table->string('CreatedBy')->index()->default('TDNAM');
            $table->string('UpdatedBy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seeker_jobs');
    }
}
