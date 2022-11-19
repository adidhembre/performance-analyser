<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyserTable extends Migration
{
    private function getConnectionName()
    {
        if(config('analyser.connection') != null){
            return config('analyser.connection');
        }
        return 'mysql';
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection($this->getConnectionName())->create('analyser', function (Blueprint $table) {
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
        Schema::connection($this->getConnectionName())->dropIfExists('analyser');
    }
}
