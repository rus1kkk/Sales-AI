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
        Schema::create('specification_documents', function (Blueprint $table) {
            $table->id('id_document');
            $table->unsignedBigInteger('id_chat');
            $table->string('version', 20);
            $table->timestamps();

            $table->foreign('id_chat')->references('id_chat')->on('chats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specification_documents', function (Blueprint $table) {
            $table->dropForeign(['id_chat']);
        });

        Schema::dropIfExists('specification_documents');
    }
};
