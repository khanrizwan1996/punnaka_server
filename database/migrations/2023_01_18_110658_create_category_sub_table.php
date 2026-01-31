<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorySubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_sub', function (Blueprint $table) {
            $table->id('cat_sub_id');
            $table->integer('cat_sub_main_id')->nullable()->default(0);
            $table->integer('cat_sub_status')->nullable()->default(0);
            $table->string('cat_sub_name', 255)->nullable();
            $table->string('cat_sub_image', 255)->nullable();
            $table->dateTime('cat_sub_added_time')->nullable();
            $table->dateTime('cat_sub_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_sub');
    }
}
