<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mall', function (Blueprint $table) {
            $table->increments('mall_id');
            $table->string('mall_status')->nullable()->default(0)->comment('active = 1 , in active = 0');
            $table->string('mall_name')->nullable();
            $table->string('mall_contact_no')->nullable();
            $table->string('mall_email')->nullable();
            $table->longText('mall_desc')->nullable();
            $table->string('mall_location')->nullable();
            $table->string('mall_city')->nullable();
            $table->string('mall_opening_date')->nullable();
            $table->string('mall_timing')->nullable();
            $table->string('mall_store_timing')->nullable();
            $table->string('mall_website_link')->nullable();
            $table->string('mall_logo')->nullable();
            $table->text('mall_meta_title')->nullable();
            $table->text('mall_meta_keyword')->nullable();
            $table->text('mall_meta_description')->nullable();
            $table->dateTime('mall_added_time')->nullable();
            $table->dateTime('mall_changed_time')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mall');
    }
}
