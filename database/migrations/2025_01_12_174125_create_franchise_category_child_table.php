<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseCategoryChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_category_child', function (Blueprint $table) {
            $table->id('fcc_id');
            $table->integer('fcc_cat_main_id')->default(0);
            $table->integer('fcc_cat_sub_id')->default(0);
            $table->string('fcc_name')->nullable();
            $table->integer('fcc_status')->default(0)->comment('Active: 1 , InActive: 0');
            $table->dateTime('fcc_added_time')->nullable();
            $table->dateTime('fcc_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchise_category_child');
    }
}
