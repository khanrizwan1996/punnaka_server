<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlogAdminCommentToBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog', function (Blueprint $table) {
             if(!Schema::hasColumn('blog', 'blog_admin_comment')) {
                $table->text('blog_admin_comment')->nullable(true);
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
        Schema::table('blog', function (Blueprint $table) {
            $table->text('blog_admin_comment')->nullable(true);
        });
    }
}
