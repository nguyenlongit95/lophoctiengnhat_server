<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseThematicSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_thematic_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_thematic_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('info', 255);
            $table->longText('description');
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
        Schema::dropIfExists('course_thematic_sources');
    }
}
