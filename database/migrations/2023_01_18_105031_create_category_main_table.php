<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_main', function (Blueprint $table) {
            $table->id('cat_main_id');
            $table->string('cat_main_type', 100)->nullable();
            $table->string('cat_main_name', 255)->nullable();
            $table->integer('cat_main_status')->nullable()->default(0);
            $table->dateTime('cat_main_added_time')->nullable();
            $table->dateTime('cat_main_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_main');
    }
}
