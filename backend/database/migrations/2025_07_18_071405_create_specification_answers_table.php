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
        Schema::create('specification_answers', function (Blueprint $table) {
            $table->id('id_answer');
            $table->unsignedBigInteger('id_document');
            $table->unsignedBigInteger('id_question');
            $table->text('answer');
            $table->text('answer_formatted')->nullable();
            $table->timestamp('created_at');

            $table->foreign('id_document')->references('id_document')->on('specification_documents');
            $table->foreign('id_question')->references('id_question')->on('section_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Specification_Answers');
    }
};
