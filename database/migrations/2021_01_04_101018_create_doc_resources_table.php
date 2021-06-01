<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doc_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('info', 255);
            $table->string('description', 255);
            $table->longText('url_source');
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
        Schema::dropIfExists('doc_resources');
    }
}
