<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('securityques');
            $table->string('securityanswer');
            $table->text('attempt',10000)->nullable();;
            $table->text('review',1000)->nullable();;
            $table->text('status',1000)->nullable();;
            $table->text('questions',50000)->nullable();
            $table->string('min')->nullable();
            $table->string('sec')->nullable();
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
        Schema::dropIfExists('attempts');
    }
}
