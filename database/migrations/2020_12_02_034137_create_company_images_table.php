<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_images', function (Blueprint $table) {
            $table->bigIncrements('CompanyImageId');
            $table->unsignedBigInteger('RecruiterId');
            $table->foreign('RecruiterId')
                ->references('id')
                ->on('recruiters')
                ->onDelete('cascade');
            $table->string('Image')->nullable();
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
        Schema::dropIfExists('company_images');
    }
}
