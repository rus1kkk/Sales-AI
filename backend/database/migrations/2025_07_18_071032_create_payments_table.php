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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id_payment');
            $table->unsignedBigInteger('id_user');
            $table->integer('amount');
            $table->enum('type', ['card', 'bank_transfer', 'crypto']); //TODO: Уточнить значения видов оплаты
            $table->enum('status', ['pending', 'completed', 'failed']); // TODO: Уточнить значения статусов оплаты
            $table->timestamp('timestamp');

            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
