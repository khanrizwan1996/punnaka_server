<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrAdminCommentCommentToPressReleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('press_release', function (Blueprint $table) {
             if (!Schema::hasColumn('press_release', 'pr_admin_comment')) {
            $table->text('pr_admin_comment')->nullable(true);
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
        Schema::table('press_release', function (Blueprint $table) {
            //
        });
    }
}
