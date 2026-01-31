<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('business_listing_review', function (Blueprint $table) {
            $table->id('blr_id');
            $table->integer('blr_business_listing_id')->nullable(false)->index('index_blr_business_listing_id');
            $table->integer('blr_user_id')->nullable(true)->default(0)->index('index_blr_user_id');
            $table->integer('blr_status')->nullable(false)->default(0)->index('index_blr_status_id');
            $table->string('blr_star',30)->nullable(true);
            $table->string('blr_review',255)->nullable(true);
            $table->dateTime('blr_adde_time')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('business_listing_review');
    }
}

