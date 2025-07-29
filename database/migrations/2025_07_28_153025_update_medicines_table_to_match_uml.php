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
        Schema::table('medicines', function (Blueprint $table) {
            // Drop existing columns that don't match UML
            $table->dropColumn(['code', 'category', 'stock_quantity', 'min_stock_level', 'supplier_id', 'is_active']);
            
            // Add new columns according to UML
            $table->string('medicine_name')->after('id');
            $table->text('description')->nullable()->change();
            $table->decimal('price', 10, 2)->change();
            $table->integer('stock')->default(0)->after('price');
            $table->foreignId('category_id')->nullable()->after('stock');
            $table->string('image_url')->nullable()->after('category_id');
            $table->timestamp('expired_at')->nullable()->after('updated_at');
            
            // Add indexes
            $table->index('category_id');
            $table->index('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            // Drop new columns
            $table->dropIndex(['category_id']);
            $table->dropIndex(['expired_at']);
            $table->dropColumn(['medicine_name', 'stock', 'category_id', 'image_url', 'expired_at']);
            
            // Restore original columns
            $table->string('code', 20)->unique();
            $table->string('category')->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('min_stock_level')->default(10);
            $table->foreignId('supplier_id')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }
};
