<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('theses', function (Blueprint $table){
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('lecturer_id')->unsigned();
            $table->string('title');
            $table->string('semester');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->boolean('is_finished')->default(false);
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

            $table->foreign('lecturer_id')
                ->references('id')
                ->on('lecturers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('theses');
    }
}
