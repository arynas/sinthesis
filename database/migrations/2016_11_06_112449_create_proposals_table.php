<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table){
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('file_id')->unsigned();
            $table->integer('theses_id')->unsigned()->nullable();
            $table->string('title');
            $table->boolean('is_check')->nullable();
            $table->timestamps();

            $table->foreign('theses_id')->references('id')->on('theses');
            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('proposals');
    }
}
