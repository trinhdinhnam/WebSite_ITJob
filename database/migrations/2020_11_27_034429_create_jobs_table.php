<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('JobId');
            $table->string('JobName');
            $table->unsignedBigInteger('PositionId');
            $table->unsignedBigInteger('LanguageId');
            $table->longText('Require')->nullable();
            $table->longText('Description')->nullable();
            $table->double('Salary')->default(0);
            $table->string('Address')->nullable();
            $table->date('StartDateApply');
            $table->date('EndDateApply');
            $table->string('Image')->nullable();
            $table->tinyInteger('Status')->index()->default(1);
            $table->unsignedBigInteger('AdminId');
            $table->unsignedBigInteger('RecruiterId');
            $table->timestamps();
            $table->foreign('PositionId')
            ->references('PositionId')
            ->on('positions')
            ->onDelete('cascade');
            $table->foreign('LanguageId')
            ->references('LanguageId')
            ->on('languages')
            ->onDelete('cascade');
            $table->foreign('AdminId')
            ->references('id')
            ->on('admins')
            ->onDelete('cascade');
            $table->foreign('RecruiterId')
            ->references('id')
            ->on('recruiters')
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
        Schema::dropIfExists('jobs');
    }
}
