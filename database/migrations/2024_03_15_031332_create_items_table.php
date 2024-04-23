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
            $table->string('name');
            $table->string('category');
            $table->string('serial_no')->nullable();
            $table->string('model')->nullable();
            $table->string('description')->nullable();
            $table->string('additional_details')->nullable();
            $table->string('status');

            $table->unsignedBigInteger('added_by');

            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');

            $table->string('condition');
            $table->string('location')->nullable();
            $table->string('date_acquisition');
            $table->string('date_added');
            $table->string('barcode')->nullable();
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
