<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddBusAdminCommentToBusinessListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_listing', function (Blueprint $table) {
            if (!Schema::hasColumn('business_listing', 'bus_admin_comment')) {
            $table->string('bus_admin_comment', 255)->nullable();
            }
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
            //
        });
    }
}
