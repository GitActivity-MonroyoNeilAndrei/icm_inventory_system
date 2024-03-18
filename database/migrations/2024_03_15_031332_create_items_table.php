<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_id');
            $table->string('name');
            $table->string('category');
            $table->string('serial_no');
            $table->string('model');
            $table->string('description');
            $table->string('additional_details');
            $table->string('status');
            $table->integer('added_by');
            $table->string('date_acquisition');
            $table->string('date_added');
            $table->string('csv_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
