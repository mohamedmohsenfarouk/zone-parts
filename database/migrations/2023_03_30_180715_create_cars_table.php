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

            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');

            $table->unsignedBigInteger('brands_id');
            $table->foreign('brands_id')->references('id')->on('brands')->onDelete('cascade');


            $table->unsignedBigInteger('models_id');
            $table->foreign('models_id')->references('id')->on('models')->onDelete('cascade');

            $table->unsignedBigInteger('power_hours_id');
            $table->foreign('power_hours_id')->references('id')->on('power_hours')->onDelete('cascade');

            $table->enum('transporter', ['automatic', 'manual'])->nullable();


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
        Schema::dropIfExists('cars');
    }
}
