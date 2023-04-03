<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_places', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('location', 255);
            $table->string('phone', 20);
            $table->string('image', 255);
            $table->enum('status', ['active', 'certified', 'the best'])->nullable();
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
        Schema::dropIfExists('maintenance_places');
    }
}
