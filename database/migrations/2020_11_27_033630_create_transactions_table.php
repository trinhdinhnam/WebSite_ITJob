<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('TransactionId');
            $table->unsignedBigInteger('RecruiterId');
            $table->unsignedBigInteger('AccountPackageId');
            $table->date('PayDate');
            $table->date('ExipryDate')->nullable();
            $table->foreign('RecruiterId')
            ->references('id')
            ->on('recruiters')
            ->onDelete('cascade');
            $table->foreign('AccountPackageId')
            ->references('AccountPackageId')
            ->on('account_packages')
            ->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
