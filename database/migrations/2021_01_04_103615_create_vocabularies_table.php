<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVocabulariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vn_text',255);
            $table->string('jp_text',255);
            $table->string('name', 255);
            $table->string('han_tu', 255);
            $table->string('han_speck', 255);
            $table->string('info', 255);
            $table->string('jp_sound',255);
            $table->string('vn_sound',255);
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
        Schema::dropIfExists('vocabularies');
    }
}
