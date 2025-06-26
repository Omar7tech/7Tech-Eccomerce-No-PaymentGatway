<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('weight', 8, 2)->nullable(); // in kilograms
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height',  8, 2)->nullable();
            $table->decimal('depth', 8, 2)->nullable();
            $table->text('description')->nullable()->default(null);
            $table->text('brief_description')->nullable()->default(null);
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->integer('sort')->default(0);
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();

            // Status flags with indexes
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_new')->default(false)->index();
            $table->boolean('is_on_sale')->default(false)->index();

            $table->decimal('sale_price', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
