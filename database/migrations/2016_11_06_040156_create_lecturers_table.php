<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->integer('nik');
            $table->integer('nidn')->nullable();
            $table->string('bornplace')->nullable();
            $table->string('borndate')->nullable();
            $table->string('address')->nullable();
            $table->string('phoneI')->nullable();
            $table->string('phoneII')->nullable();
            $table->boolean('sex')->nullable();
            $table->enum('blood', array('A', 'AB', 'B','O'))->nullable();
            $table->string('stay')->nullable();
            $table->string('motto')->nullable();
            $table->string('functional')->nullable();
            $table->string('structural')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::drop('lecturers');
    }
}
