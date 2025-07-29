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
        Schema::table('shippings', function (Blueprint $table) {
            $table->enum('transaction_type', ['purchase', 'sales'])->default('purchase')->after('transaction_id');
            
            $table->index(['transaction_id', 'transaction_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropIndex(['transaction_id', 'transaction_type']);
            $table->dropColumn('transaction_type');
        });
    }
};
