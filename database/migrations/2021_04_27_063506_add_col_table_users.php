<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address', 255)->nullable();
            $table->string('school', 255)->nullable();
            $table->tinyInteger('gender')->nullable(); // 0: man 1: woman
            $table->string('job', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->timestamp('birth_day')->nullable();
            $table->string('avatar', 255)->nullable();
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
