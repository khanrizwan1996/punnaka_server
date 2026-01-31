<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_enquiry', function (Blueprint $table) {
            $table->id('se_id');
            $table->string('se_status')->nullable()->default(0);
            $table->string('se_user_name')->nullable();
            $table->string('se_user_email')->nullable();
            $table->string('se_user_contact_no')->nullable();
            $table->string('se_message')->nullable();
            $table->string('se_services')->nullable();
            $table->dateTime('se_added_time')->nullable();
            $table->dateTime('se_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_enquiry');
    }
}
