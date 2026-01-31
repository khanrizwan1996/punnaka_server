<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerTitleBannerShortDescToBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner', function (Blueprint $table) {
            $table->string('banner_title')->nullable()->after('banner_id');
            $table->string('banner_short_desc',255)->nullable()->after('banner_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner', function (Blueprint $table) {
            $table->string('banner_titel')->nullable()->after('banner_id');
            $table->string('banner_short_desc',255)->nullable()->after('banner_image');
        });
    }
}
