<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_content', function (Blueprint $table) {
            $table->increments('wc_id');
            $table->string('wc_header_logo')->nullable();
            $table->string('wc_footer_logo')->nullable();
            $table->string('wc_footer_content')->nullable();
            $table->string('wc_contact_no')->nullable();
            $table->string('wc_email_address')->nullable();
            $table->string('wc_address')->nullable();
            $table->string('wc_fb_link')->nullable();
            $table->string('wc_insta_link')->nullable();
            $table->string('wc_pinterest_link')->nullable();
            $table->string('wc_quora_link')->nullable();
            $table->string('wc_whatsapp_link')->nullable();
            $table->string('wc_term_condition')->nullable();
            $table->string('wc_privacy_policy')->nullable();
            $table->dateTime('wc_update_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_content');
    }
}
