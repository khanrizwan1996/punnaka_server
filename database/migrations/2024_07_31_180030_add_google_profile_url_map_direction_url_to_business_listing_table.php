<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleProfileUrlMapDirectionUrlToBusinessListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_listing', function (Blueprint $table) {
            $table->string('bus_google_profile_url')->nullable()->after('bus_payment_country');
            $table->string('bus_map_direction_url')->nullable()->after('bus_google_profile_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_listing', function (Blueprint $table) {
            $table->dropColumn('bus_google_profile_url');
            $table->dropColumn('bus_map_direction_url');
        });
    }
}
