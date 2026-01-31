<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseCategorySubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_category_sub', function (Blueprint $table) {
            $table->id('fcs_id');
            $table->integer('fcs_cat_main_id')->default(0);
            $table->string('fcs_name')->nullable();
            $table->integer('fcs_status')->default(0)->comment('Active: 1 , InActive: 0');
            $table->dateTime('fcs_added_time')->nullable();
            $table->dateTime('fcs_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchise_category_sub');
    }
}
