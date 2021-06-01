<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourseThematicCourseWork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * {"drought":"asd","chinese":"zxc","meaning":"asd","sound_vn":"\/source\/sound\/file26.mp3","sound_jp":null}
     */
    public function up()
    {
        Schema::create('course_thematic_sources_work', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_thematic_sources_id');
            $table->string('source')->nullable();
            $table->string('drought')->nullable();
            $table->string('chinese')->nullable();
            $table->string('meaning')->nullable();
            $table->string('sound_vn')->nullable();
            $table->string('sound_jp')->nullable();
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
        //
    }
}
