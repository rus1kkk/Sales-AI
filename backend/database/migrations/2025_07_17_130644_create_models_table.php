<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->string('model_name')->primary();
            $table->string('model_fullname');
            $table->text('model_info');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
