<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPsAdminCommentToProductServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_service', function (Blueprint $table) {
            if (!Schema::hasColumn('product_service', 'ps_admin_comment')) {
            $table->string('ps_admin_comment', 255)->nullable();
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
        Schema::table('product_service', function (Blueprint $table) {
            //
        });
    }
}
