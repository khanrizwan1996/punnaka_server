<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_detail', function (Blueprint $table) {
            $table->increments('pd_id');
            $table->integer('pd_plan_id')->default(0);
            $table->string('pd_description')->nullable();
            $table->dateTime('pd_added_time')->nullable();
            $table->dateTime('pd_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_detail');
    }
}
