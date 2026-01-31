<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusPayPaymentCurrencyToBusinessListingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_listing_payments', function (Blueprint $table) {
            $table->string('bus_pay_payment_currency', 10)->after('bus_pay_plan_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_listing_payments', function (Blueprint $table) {
            //
        });
    }
}
