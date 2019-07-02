<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalInstituteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goal_institute', function (Blueprint $table) {
            $table->unsignedInteger('institute_id');
            $table->foreign('institute_id')->references('id')->on('institutes');
            $table->unsignedInteger('goal_id');
            $table->foreign('goal_id')->references('id')->on('goals');
            $table->text('services');
            $table->text('possibilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goal_institute');
    }
}
