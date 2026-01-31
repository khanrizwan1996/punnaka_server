<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlogCatAdminCommentToBlogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_category', function (Blueprint $table) {
            if (!Schema::hasColumn('blog_category', 'blog_cat_admin_comment')) {
            $table->text('blog_cat_admin_comment')->nullable(true);
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
        Schema::table('blog_category', function (Blueprint $table) {
            //
        });
    }
}
