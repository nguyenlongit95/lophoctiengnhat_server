<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlSrouceClassToCourseOnline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_online_source', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_online_id');
            $table->string('class_name', 255)->nullable();
            $table->string('url_source_class', 255)->nullable();
            $table->tinyInteger('state')->default(0); // 1 Dang dien ra, 0 chua dien ra hoac da dien ra
            $table->integer('sort')->nullable();
            $table->timestamps();
        });

        Schema::table('course_thematics', function (Blueprint $table) {
            $table->integer('video_type')->default(0); // 0: youtube, 1: google driver, 2 upload video
        });

        Schema::table('course_levels', function (Blueprint $table) {
            $table->string('video_link', 255)->nullable();
            $table->integer('video_type')->default(0); // 0: youtube, 1: google driver, 2 upload video
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_online_source', function (Blueprint $table) {
            // drop table
        });
    }
}
