<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_link');
            $table->string('instegram_link');
            $table->string('snapchat_link');
            $table->string('twitter_link');
            $table->string("what's_app_link");
            $table->string('phone_call_center');
            $table->string('profit_ratio',50);
            $table->string('delivery_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
