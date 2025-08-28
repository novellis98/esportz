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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2); // Importo del pagamento
            $table->string('payment_method'); // Metodo di pagamento (carta, PayPal, ecc.)
            // $table->string('status'); // Stato del pagamento (completato, in attesa, ecc.)
            // $table->string('payment_gateway'); // Gateway di pagamento (Stripe, PayPal, ecc.)
            $table->timestamp('payment_date')->useCurrent(); // Data e ora del pagamento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
