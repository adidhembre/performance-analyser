<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('analyser', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->nullable();
            $table->text('route')->nullable();
            $table->text('method')->nullable();
            $table->json('params')->nullable();
            $table->text('referer')->nullable();
            $table->text('host')->nullable();
            $table->integer('sqlcalls')->nullable();
            $table->double('sqltime', 15,8)->nullable();
            $table->dateTime('starttime')->nullable();
            $table->dateTime('endtime')->nullable();
            $table->integer('status')->nullable();
            $table->double('time',15,8)->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('analyser');
    }
}
