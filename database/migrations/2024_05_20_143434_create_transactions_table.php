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
            $table->string('transaction_number');
            $table->timestamp('tgl');
            $table->unsignedBigInteger('customer_id');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('diskon', 10, 2)->nullable(true);
            $table->decimal('ongkir', 10, 2)->nullable(true);
            $table->decimal('total_bayar', 10, 2);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
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
