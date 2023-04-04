<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 100);
            $table->string('name_ar', 100);
            $table->string('image', 255);
            $table->string('year', 100);

            $table->enum('status', ['new', 'used'])->nullable(); //الناقل لسه مش عارفة 

            $table->unsignedBigInteger('brands_id');
            $table->foreign('brands_id')->references('id')->on('brands')->onDelete('cascade');


            $table->unsignedBigInteger('models_id');
            $table->foreign('models_id')->references('id')->on('models')->onDelete('cascade');

            $table->unsignedBigInteger('powerhours_id');
            $table->foreign('powerhours_id')->references('id')->on('power_hours')->onDelete('cascade');
            
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
        Schema::dropIfExists('cars');
    }
}
