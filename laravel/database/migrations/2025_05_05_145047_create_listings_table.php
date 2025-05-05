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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            // Foreign key referencing NFT (assuming n_f_t_s table exists)
            $table->foreignId('nft_id')->constrained('n_f_t_s')->onDelete('cascade');
            // Foreign key referencing User (seller)
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            // Price with decimal type (10 digits, 2 decimal places)
            $table->decimal('price', 10, 2);
            // Currency of the price
            $table->string('currency');
            // Listing status (active, sold, cancelled)
            $table->enum('status', ['active', 'sold', 'cancelled']);
            // Expiration timestamp (nullable if you want no expiration in some cases)
            $table->timestamp('expiration')->nullable();
            // Timestamps for created_at and updated_at
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
