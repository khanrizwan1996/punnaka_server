<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWriteForUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('write_for_us', function (Blueprint $table) {
            $table->id('wfu_id');
            $table->string('wfu_status')->nullable()->default(0);
            $table->string('wfu_user_name')->nullable();
            $table->string('wfu_user_email')->nullable();
            $table->string('wfu_user_contact_no')->nullable();
            $table->string('wfu_message')->nullable();
            $table->dateTime('wfu_added_time')->nullable();
            $table->dateTime('wfu_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('write_for_us');
    }
}
