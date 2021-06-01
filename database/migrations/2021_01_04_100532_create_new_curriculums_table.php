<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewCurriculumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_curriculums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('info', 255);
            $table->longText('description');
            $table->longText('code');
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
        Schema::dropIfExists('new_curriculums');
    }
}
