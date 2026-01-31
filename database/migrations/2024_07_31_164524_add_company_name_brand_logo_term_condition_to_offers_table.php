<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyNameBrandLogoTermConditionToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('offer_company_name')->nullable();
            $table->string('offer_brand_image')->nullable();
            $table->longText('offer_t_c')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('offer_company_name');
            $table->dropColumn('offer_brand_image');
            $table->dropColumn('offer_t_c');
        });
    }
}
