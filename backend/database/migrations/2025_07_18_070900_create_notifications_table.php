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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['info', 'warning', 'error']); // TODO: Уточнить значения (тип уведомления)
            $table->string('notifiable_type')->default('App\Models\User');
            $table->unsignedBigInteger('notifiable_id');
            $table->timestamp('timestamp');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
