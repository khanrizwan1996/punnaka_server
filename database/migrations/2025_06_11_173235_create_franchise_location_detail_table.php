<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseLocationDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_location_detail', function (Blueprint $table) {
            $table->id('fld_id');
            $table->string('fld_franchise_id')->nullable();
            $table->string('fld_country')->nullable();
            $table->string('fld_state')->nullable();
            $table->string('fld_city')->nullable();
            $table->dateTime('fld_added_timestamp')->nullable();
            $table->dateTime('fld_changed_timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchise_location_detail');
    }
}
