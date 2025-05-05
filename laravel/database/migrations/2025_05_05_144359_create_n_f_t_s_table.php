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
        Schema::create('n_f_t_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('token_id')->unique(); 
            $table->foreignId('collection_id')->constrained('collections')->nullable(); // Nullable if collection is optional
            $table->string('name');
            $table->string('description');
            $table->text('media_url');
            $table->text('metadata_url');
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n_f_t_s');
    }
};
