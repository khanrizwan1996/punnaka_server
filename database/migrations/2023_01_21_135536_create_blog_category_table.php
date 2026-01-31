<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_category', function (Blueprint $table) {
            $table->id('blog_cat_id');
            $table->integer('blog_cat_status')->nullable()->default(0);
            $table->string('blog_cat_maincat', 255)->nullable();
            $table->string('blog_cat_subcat', 255)->nullable();
            $table->string('blog_cat_title', 255)->nullable();
            $table->longText('blog_cat_desc')->nullable();
            $table->string('blog_cat_start_date', 255)->nullable();
            $table->string('blog_cat_start_time', 255)->nullable();
            $table->string('blog_cat_country', 255)->nullable();
            $table->string('blog_cat_state', 255)->nullable();
            $table->string('blog_cat_city', 255)->nullable();
            $table->string('blog_cat_image', 255)->nullable();
            $table->string('blog_cat_country_image', 255)->nullable();
            $table->string('blog_cat_state_image', 255)->nullable();
            $table->string('blog_cat_city_image', 255)->nullable();
            $table->string('blog_cat_subcat_image', 255)->nullable();
            $table->string('blog_cat_meta_title', 255)->nullable();
            $table->longText('blog_cat_meta_desc')->nullable();
            $table->longText('blog_cat_meta_keyword')->nullable();
            $table->dateTime('blog_cat_added_time')->nullable();
            $table->dateTime('blog_cat_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_category');
    }
}
