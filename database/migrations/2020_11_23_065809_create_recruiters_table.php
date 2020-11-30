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
            $table->string('Avatar')->nullable();
            $table->string('Email')->unique();
            $table->char('Phone');
            $table->string('Password');
            $table->string('CompanyName');
            $table->string('Address');
            $table->string('City');
            $table->string('Introduction')->nullable();
            $table->string('Image')->nullable();
            $table->string('TimeWork');
            $table->string('WorkDay');
            $table->string('CompanySize');
            $table->string('TypeBusiness')->nullable();
            $table->tinyInteger('Active')->default(1)->index();
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
        Schema::dropIfExists('recruiters');
    }
}
