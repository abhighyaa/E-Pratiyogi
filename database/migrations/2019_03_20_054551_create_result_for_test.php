<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultForTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_test', function (Blueprint $table) {
            $table->integer('result_id')->unsigned()->index();
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            $table->integer('test_id')->unsigned()->index();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('result_test');
    }
}
