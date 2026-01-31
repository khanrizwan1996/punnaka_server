<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing_payments', function (Blueprint $table) {
            $table->increments('bus_pay_id');
            $table->string('bus_pay_status')->nullable()->default(0)->comment('not_pay = 0 , pay = 1');
            $table->string('bus_pay_business_id')->nullable();
            $table->string('bus_pay_payment_id')->nullable();
            $table->string('bus_pay_user_name')->nullable();
            $table->string('bus_pay_user_email')->nullable();
            $table->string('bus_pay_user_contact_no')->nullable();
            $table->string('bus_pay_user_business_name')->nullable();
            $table->string('bus_pay_plan_type')->nullable();
            $table->string('bus_pay_amount')->nullable();
            $table->dateTime('bus_pay_added_time')->nullable();
            $table->dateTime('bus_pay_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_listing_payments');
    }
}
