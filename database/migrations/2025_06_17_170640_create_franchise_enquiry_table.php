<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_enquiry', function (Blueprint $table) {
            $table->id('fe_id');
            $table->string('fe_franchise_id')->nullable();
            $table->string('fe_name')->nullable();
            $table->string('fe_email')->nullable();
            $table->string('fe_contact_no')->nullable();
            $table->string('fe_country')->nullable();
            $table->string('fe_state')->nullable();
            $table->string('fe_city')->nullable();
            $table->string('fe_investment_range')->nullable();
            $table->string('fe_address')->nullable();
            $table->dateTime('fe_added_timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchise_enquiry');
    }
}
