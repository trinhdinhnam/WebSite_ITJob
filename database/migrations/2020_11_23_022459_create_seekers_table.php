<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seekers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SeekerName');
            $table->string('Email')->unique();
            $table->string('Phone')->nullable();
            $table->date('DateOfBirth');
            $table->tinyInteger('Gender')->default(1)->index();
            $table->string('Address')->nullable();
            $table->string('Password');
            $table->string('Avatar')->nullable();
            $table->tinyInteger('Active')->default(1)->index();
            $table->string('CreatedBy')->index()->default('TDNAM');
            $table->string('UpdatedBy')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('seekers');
    }
}
