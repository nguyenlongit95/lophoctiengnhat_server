<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleEWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_wallet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('amount')->default(0);
            $table->integer('total_charge')->default(0);
            $table->string('note')->nullable();
            $table->tinyInteger('status'); // 0: block 1: default
            $table->timestamps();
        });

        Schema::create('e_wallet_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('e_wallet_id');
            $table->float('price');
            $table->timestamp('time_charge');
            $table->string('code_charge')->nullable();
            $table->tinyInteger('status'); // 0: mua khoa hoc 1: nap them tien
            $table->timestamps();
        });

        Schema::create('e_wallet_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('e_wallet_detail_id');
            $table->float('note');
            $table->timestamp('time_charge');
            $table->string('paygate')->nullable();
            $table->string('code_charge')->nullable();
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
        Schema::dropIfExists('module_e_wallet');
    }
}
