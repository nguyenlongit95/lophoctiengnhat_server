<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColummnPriceToCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add to table doc_resources
        Schema::table('doc_resources', function (Blueprint $table) {
            $table->float('price')->nullable();
            $table->string('code', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course', function (Blueprint $table) {

        });
    }
}
