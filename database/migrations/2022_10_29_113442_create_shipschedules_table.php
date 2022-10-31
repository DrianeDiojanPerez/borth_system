<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipschedules', function (Blueprint $table) {
            $table->id();
            $table->string('vessel_name');
            $table->string('voyage_number');
            $table->date('ata');
            $table->date('atd');
            $table->boolean('empty');
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
        Schema::dropIfExists('shipschedules');
    }
};
