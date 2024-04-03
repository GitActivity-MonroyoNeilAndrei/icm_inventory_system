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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date')->default(now());

            $table->unsignedBigInteger('item');
            $table->unsignedBigInteger('issued_to');
            $table->unsignedBigInteger('issued_by');

            $table->foreign('item')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('issued_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('cascade');

            $table->string('status');

            $table->string('condition');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
