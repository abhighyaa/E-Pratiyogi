<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('tc1');
            $table->string('op1');
            $table->string('tc2');
            $table->string('op2');
            $table->string('tc3');
            $table->string('op3');
            $table->string('complexity');
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
        Schema::dropIfExists('codings');
    }
}
