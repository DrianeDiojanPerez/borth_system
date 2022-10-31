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
        Schema::create('pacling_lists', function (Blueprint $table) {
            $table->id();
            $table->string('bill_of_lading');
            $table->integer('voyage_number');
            $table->string('container');
            $table->longText('agent');
            $table->longText('consignee');
            $table->longText('description');
            $table->integer('quantity');
            $table->string('package_type');
            $table->string('reference_number');
            $table->string('weight_unit');
            $table->integer('weight');
            $table->string('dimentions_unit');
            $table->integer('height');
            $table->integer('width');
            $table->integer('length');
            $table->bigInteger('dock_receipt_number');
            $table->longText('shipping_marks');
            $table->string('hoouse_BOL');
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
        Schema::dropIfExists('packing_list');
    }
};
