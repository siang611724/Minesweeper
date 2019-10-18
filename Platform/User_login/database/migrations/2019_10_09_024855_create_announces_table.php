<?php

<<<<<<< HEAD

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncesTable extends Migration
=======
<<<<<<< HEAD:Platform/User_login/vendor/laravel/framework/src/Illuminate/Queue/Console/stubs/failed_jobs.stub
=======

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
>>>>>>> project/jimmy:Platform/User_login/database/migrations/2019_10_09_024855_create_announces_table.php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

<<<<<<< HEAD:Platform/User_login/vendor/laravel/framework/src/Illuminate/Queue/Console/stubs/failed_jobs.stub
class Create{{tableClassName}}Table extends Migration
=======
class CreateAnnouncesTable extends Migration
>>>>>>> project/jimmy:Platform/User_login/database/migrations/2019_10_09_024855_create_announces_table.php
>>>>>>> project/jimmy
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::create('announces', function (Blueprint $table) {
=======
<<<<<<< HEAD:Platform/User_login/vendor/laravel/framework/src/Illuminate/Queue/Console/stubs/failed_jobs.stub
        Schema::create('{{table}}', function (Blueprint $table) {
=======
        Schema::create('announces', function (Blueprint $table) {
>>>>>>> project/jimmy:Platform/User_login/database/migrations/2019_10_09_024855_create_announces_table.php
>>>>>>> project/jimmy
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->date('releaseDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD
        Schema::dropIfExists('announces');
=======
<<<<<<< HEAD:Platform/User_login/vendor/laravel/framework/src/Illuminate/Queue/Console/stubs/failed_jobs.stub
        Schema::dropIfExists('{{table}}');
=======
        Schema::dropIfExists('announces');
>>>>>>> project/jimmy:Platform/User_login/database/migrations/2019_10_09_024855_create_announces_table.php
>>>>>>> project/jimmy
    }
}
