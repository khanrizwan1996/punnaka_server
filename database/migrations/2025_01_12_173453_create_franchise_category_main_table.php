<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseCategoryMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_category_main', function (Blueprint $table) {
            $table->id('fcm_id');
            $table->string('fcm_name')->nullable();
            $table->integer('fcm_status')->nullable()->default(0)->comment('Active: 1 , InActive: 0');
            $table->dateTime('fcm_added_time')->nullable();
            $table->dateTime('fcm_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('franchise_category_main');
    }
}
