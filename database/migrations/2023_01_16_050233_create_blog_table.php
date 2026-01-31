<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id('blog_id');
            $table->bigInteger('blog_status')->nullable()->default(0);
            $table->string('blog_maincat_name');
            $table->longText('blog_detail')->nullable()->default('text');
            $table->string('blog_image');
            $table->text('blog_meta_title')->nullable()->default('text');
            $table->text('blog_meta_keword')->nullable()->default('text');
            $table->text('blog_meta_description')->nullable()->default('text');
            $table->dateTime('blog_added_timestamp')->nullable();
            $table->dateTime('blog_changed_timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
