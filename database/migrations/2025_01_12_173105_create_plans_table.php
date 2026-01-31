<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('p_id');
            $table->string('p_title')->nullable();
            $table->string('p_type')->nullable();
            $table->string('p_short_desc')->nullable();
            $table->integer('p_price')->default(0);
            $table->integer('p_status')->nullable()->default(0)->comment('Active: 1 , InActive: 0');
            $table->dateTime('p_added_time')->nullable();
            $table->dateTime('p_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
