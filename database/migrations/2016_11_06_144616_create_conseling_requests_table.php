<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConselingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conseling_requests', function (Blueprint $table){
            $table->increments('id');
            $table->integer('conseling_schedule_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->boolean('is_confirmed')->nullable();
            $table->timestamps();

            $table->foreign('conseling_schedule_id')->references('id')->on('conseling_schedules')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conseling_requests');
    }
}
