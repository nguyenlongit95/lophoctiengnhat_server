<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->longText('question');
            $table->longText('answer1');
            $table->longText('answer2');
            $table->longText('answer3');
            $table->longText('answer4');
            $table->integer('correct_answer');
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
        Schema::dropIfExists('question_details');
    }
}
