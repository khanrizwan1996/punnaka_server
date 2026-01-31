<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class Add24ColumnToBusinessListingScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_listing_schedule', function (Blueprint $table) {
            $table->integer('bus_sch_sun_time_status')->default(0)->comment('set time: 1 , 24 hours: 2')->nullable(true);
            $table->integer('bus_sch_mon_time_status')->default(0)->comment('set time: 1 , 24 hours: 2')->nullable(true);
            $table->integer('bus_sch_tue_time_status')->default(0)->comment('set time: 1 , 24 hours: 2')->nullable(true);
            $table->integer('bus_sch_wed_time_status')->default(0)->comment('set time: 1 , 24 hours: 2')->nullable(true);
            $table->integer('bus_sch_thu_time_status')->default(0)->comment('set time: 1 , 24 hours: 2')->nullable(true);
            $table->integer('bus_sch_fri_time_status')->default(0)->comment('set time: 1 , 24 hours: 2')->nullable(true);
            $table->integer('bus_sch_sat_time_status')->default(0)->comment('set time: 1 , 24 hours: 2')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_listing_schedule', function (Blueprint $table) {
            //
        });
    }
}
