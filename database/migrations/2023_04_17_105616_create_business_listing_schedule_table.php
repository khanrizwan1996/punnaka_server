<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing_schedule', function (Blueprint $table) {
            $table->id('bus_sch_id');
            $table->string('bus_sch_business_id')->nullable()->default(0);
            $table->string('bus_sch_sun_status')->nullable();
            $table->string('bus_sch_sun_start')->nullable();
            $table->string('bus_sch_sun_end')->nullable();
            $table->string('bus_sch_mon_status')->nullable();
            $table->string('bus_sch_mon_start')->nullable();
            $table->string('bus_sch_mon_end')->nullable();
            $table->string('bus_sch_tue_status')->nullable();
            $table->string('bus_sch_tue_start')->nullable();
            $table->string('bus_sch_tue_end')->nullable();
            $table->string('bus_sch_wed_status')->nullable();
            $table->string('bus_sch_wed_start')->nullable();
            $table->string('bus_sch_wed_end')->nullable();
            $table->string('bus_sch_thu_status')->nullable();
            $table->string('bus_sch_thu_start')->nullable();
            $table->string('bus_sch_thu_end')->nullable();
            $table->string('bus_sch_fri_status')->nullable();
            $table->string('bus_sch_fri_start')->nullable();
            $table->string('bus_sch_fri_end')->nullable();
            $table->string('bus_sch_sat_status')->nullable();
            $table->string('bus_sch_sat_start')->nullable();
            $table->string('bus_sch_sat_end')->nullable();
            $table->dateTime('bus_sch_added_time')->nullable();
            $table->dateTime('bus_sch_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_listing_schedule');
    }
}
