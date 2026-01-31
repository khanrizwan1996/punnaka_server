<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFAdminCommentToFranchiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('franchise', function (Blueprint $table) {
            if (!Schema::hasColumn('franchise', 'f_admin_comment')) {
             $table->string('f_admin_comment', 255)->nullable();
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
        Schema::table('franchise', function (Blueprint $table) {
            //
        });
    }
}
