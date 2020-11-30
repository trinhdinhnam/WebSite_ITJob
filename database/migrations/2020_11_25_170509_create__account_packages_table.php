<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_packages', function (Blueprint $table) {
            $table->bigIncrements('AccountPackageId');
            $table->string('AccountPackageName');
            $table->double('Price')->default(0)->index();
            $table->integer('PostNumber')->default(0)->index();
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
        Schema::dropIfExists('account_packages');
    }
}
