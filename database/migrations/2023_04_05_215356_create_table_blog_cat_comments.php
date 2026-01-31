<?php

use Brick\Math\BigNumber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

class CreateTableBlogCatComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_cat_comments', function (Blueprint $table) {
            $table->id('blogcat_comment_id');
            $table->bigInteger('blogcat_comment_status')->nullable()->default(0);
            $table->bigInteger('blogcat_comment_blog_id')->nullable()->default(0);
            $table->bigInteger('blogcat_comment_user_id')->nullable()->default(0);
            $table->string('blogcat_comment_subject', 255)->nullable();
            $table->longText('blogcat_comment_desc')->nullable();
            $table->dateTime('blogcat_comment_added_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_cat_comments');
    }
}
