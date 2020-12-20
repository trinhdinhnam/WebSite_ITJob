<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('ReviewId');
            $table->unsignedBigInteger('SeekerId');
            $table->unsignedBigInteger('RecruiterId');
            $table->string('Title');
            $table->longText('GoodReview')->nullable();
            $table->longText('NotGoodReview')->nullable();
            $table->foreign('SeekerId')
                ->references('id')
                ->on('seekers')
                ->onDelete('cascade');
            $table->foreign('RecruiterId')
                ->references('id')
                ->on('recruiters')
                ->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *-v
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
