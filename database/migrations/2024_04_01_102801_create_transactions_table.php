<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->date('transaction_date')->default(DB::raw('CURRENT_DATE'));

            $table->unsignedBigInteger('item');
            $table->unsignedBigInteger('issued_to');
            $table->unsignedBigInteger('issued_by');

            $table->foreign('item')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('issued_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('cascade');

            $table->string('transaction_status');

            $table->string('condition');


            $table->date('created_at')->useCurrent();
            $table->date('updated_at')->nullable();
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
