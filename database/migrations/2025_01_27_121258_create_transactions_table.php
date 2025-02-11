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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Links to the user
            $table->string('transaction_id')->unique(); // Unique transaction identifier
            $table->decimal('amount', 10, 2); // Amount of the transaction
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Transaction status
            $table->string('payment_method'); // e.g., credit card, PayPal
            $table->timestamp('processed_at')->nullable(); // When the transaction was processed
            $table->timestamp('expiration_date')->nullable(); // Expiration date of the payment
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
