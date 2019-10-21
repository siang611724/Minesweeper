<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('History', function (Blueprint $table) {
            $table->bigInteger('GameID')->unsigned();
            $table->foreign('GameID')->references('GameID')->on('Map');
            $table->bigInteger('MemberID')->unsigned();
            $table->foreign('MemberID')->references('id')->on('users');
            $table->integer('mapX');
            $table->integer('mapY');
            $table->string('result', 10)->default(null)->nullable();
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
        Schema::dropIfExists('histories');
    }
}
