<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaDetailsToFranchiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('franchise', function (Blueprint $table) {
            $table->text('f_meta_title')->nullable();
            $table->text('f_meta_keyword')->nullable();
            $table->text('f_meta_description')->nullable();
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
