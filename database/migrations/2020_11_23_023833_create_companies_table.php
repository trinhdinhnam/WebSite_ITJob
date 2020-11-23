<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('CompanyId');
            $table->string('CompanyName');
            $table->string('Address')->nullable();
            $table->text('Introduction')->nullable();
            $table->string('Image')->nullable();
            $table->date('StartDateWorking');
            $table->date('EndDateWorking');
            $table->integer('CompanySize')->default(1)->index();
            $table->string('TypeBussiness')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
