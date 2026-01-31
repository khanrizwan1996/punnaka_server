<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrTitle1ToPressReleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('press_release', function (Blueprint $table) {
            $table->string('pr_title1', 255)->nullable()->after('pr_title');
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
