<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('lecturer_id')->unsigned();
            $table->string('name');
            $table->integer('nim');
            $table->string('bornplace')->nullable();
            $table->string('borndate')->nullable();
            $table->string('address')->nullable();
            $table->string('phoneI')->nullable();
            $table->string('phoneII')->nullable();
            $table->boolean('sex')->nullable();
            $table->enum('blood', array('A', 'AB', 'B','O'))->nullable();
            $table->string('stay')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::drop('students');
    }
}
