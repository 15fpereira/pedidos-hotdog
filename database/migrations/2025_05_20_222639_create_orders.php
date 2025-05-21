<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_method', ['pix', 'cartao', 'entrega']);
            $table->enum('status', ['pendente', 'aprovado', 'em_preparo', 'saiu_entrega', 'finalizado', 'cancelado'])->default('pendente');
            $table->enum('order_type', ['delivery', 'retirada', 'local']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
