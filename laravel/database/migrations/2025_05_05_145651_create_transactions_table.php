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
            $table->foreignId('nft_id')->nullable()->constrained('n_f_t_s')->nullOnDelete();
            $table->foreignId('seller_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('price', 18, 8);  // Define precision and scale for decimal fields
            $table->string('currency');
            $table->string('transaction_hash', 66);  // Adjust length if needed (66 for Ethereum)
            $table->decimal('royalty_amount', 18, 8);  // Define precision and scale
            $table->decimal('platform_fee', 18, 8);   // Define precision and scale
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
