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
       // database/migrations/xxxx_xx_xx_create_cart_items_table.php
       Schema::create('cart_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->integer('quantity')->default(1);
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
