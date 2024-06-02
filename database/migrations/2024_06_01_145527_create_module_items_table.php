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
        Schema::create('module_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pos_module_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('branch_product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('product_name')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_items');
    }
};