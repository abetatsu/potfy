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
        Schema::create('portfolio_technologies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_id'); //外部キー（他のテーブルのIDを参照している）
            $table->unsignedBigInteger('technology_id'); //外部キー（他のテーブルのIDを参照している）
            $table->timestamps();
            
            $table->foreign('portfolio_id')->references('id')->on('portfolios');
            $table->foreign('technology_id')->references('id')->on('technologies');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_technologies');
    }
}
