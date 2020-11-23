<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('RecruiterName');
            $table->string('Email')->unique();
            $table->char('Phone')->nullable();
            $table->date('DateOfBirth');
            $table->tinyInteger('Gender')->default(1)->index();
            $table->string('Address')->nullable();
            $table->string('Password');
            $table->string('Avatar')->nullable();
            $table->tinyInteger('Active')->default(1)->index();
            $table->unsignedBigInteger('RecruiterLevelId');
            $table->foreign('RecruiterLevelId')
            ->references('RecruiterLevelId')
            ->on('recruiter_levels')
            ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('recruiters');
    }
}
