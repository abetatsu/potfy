<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_technology', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_id');
            $table->unsignedBigInteger('Technology_id');
            $table->timestamps();

            $table->foreign('portfolio_id')->references('id')->on('portfolios');
            $table->foreign('Technology_id')->references('id')->on('Technologies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_technology');
    }
}
