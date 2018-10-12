<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id');
            $table->integer('subject_id');
            $table->timestamps();

            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            // $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            // $table->unique(['branch_id','subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_subjects');
    }
}
