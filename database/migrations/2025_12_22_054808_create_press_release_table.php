<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePressReleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('press_release')) {
        Schema::create('press_release', function (Blueprint $table) {
            $table->increments('pr_id');
            $table->integer('pr_status')->default(0)->comment('Active: 1 , InActive: 0');
            $table->string('pr_main_cat', 255)->nullable();
            $table->string('pr_sub_cat', 255)->nullable();

            $table->string('pr_title', 255)->nullable();
            $table->string('pr_country', 255)->nullable();
            $table->string('pr_state', 255)->nullable();
            $table->string('pr_city', 255)->nullable();

            $table->string('pr_content_location', 255)->nullable();
            $table->string('pr_publisher', 255)->nullable();
            $table->string('pr_author', 255)->nullable();
            $table->string('pr_publish_date_time', 255)->nullable();
            $table->string('pr_modified_date_time', 255)->nullable();

            $table->string('pr_logo', 255)->nullable();
            $table->string('pr_attachment', 255)->nullable();
            $table->string('pr_video_embedded', 255)->nullable();

            $table->string('pr_meta_title', 255)->nullable();
            $table->string('pr_meta_keyword', 255)->nullable();
            $table->text('pr_meta_desc')->nullable();
            $table->longText('pr_desc')->nullable();

            $table->dateTime('pr_added_time')->nullable();
            $table->dateTime('pr_changed_time')->nullable();
            $table->index('pr_status','pr_status_index');
            $table->index('pr_main_cat','pr_main_cat_index');
            $table->index('pr_sub_cat','pr_sub_cat_index');
            $table->index('pr_title','pr_title_index');
            $table->index('pr_country','pr_country_index');
            $table->index('pr_state','pr_state_index');
            $table->index('pr_city','pr_city_index');
            $table->index('pr_content_location','pr_content_location_index');
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('press_release');
    }
}
