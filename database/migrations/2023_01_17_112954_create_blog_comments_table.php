<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('bc_id');
            $table->bigInteger('bc_status')->nullable()->default(0);
            $table->bigInteger('bc_blog_id')->nullable()->default(0);
            $table->bigInteger('bc_user_id')->nullable()->default(0);
            $table->string('bc_subject', 255)->nullable();
            $table->longText('bc_desc')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
}
