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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('product_id');
            $table->string('transaction_number');
            $table->decimal('harga_bandrol', 10, 2);
            $table->integer('qty');
            $table->decimal('diskon_pct', 10, 2)->nullable(true);
            $table->decimal('diskon_nilai', 10, 2)->nullable(true);
            $table->decimal('harga_diskon', 10, 2)->nullable(true);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
