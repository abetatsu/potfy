<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id'); //外部キー（他のテーブルのIDを参照している）
            $table->unsignedBigInteger('portfolio_id'); //外部キー（他のテーブルのIDを参照している）

            $table->text('body');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('portfolio_id')->references('id')->on('portfolios');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
