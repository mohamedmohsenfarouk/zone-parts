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
            $table->integer('phone_call_center');
            $table->decimal('profit_ratio',3);
            $table->decimal('delivery_service', 3);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();  
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
