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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id('shipping_id');
            $table->unsignedBigInteger('transaction_id');
            $table->string('shipping_address');
            $table->enum('status', ['shipped', 'in transit', 'delivered'])->default('shipped');
            $table->string('sender');
            $table->timestamp('shipping_date');
            $table->timestamps();
            
            $table->foreign('transaction_id')->references('transaction_id')->on('purchase_transactions')->onDelete('cascade');
            $table->index(['transaction_id', 'status']);
            $table->index('shipping_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
