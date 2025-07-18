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
        Schema::create('section_questions', function (Blueprint $table) {
            $table->id('id_question');
            $table->unsignedBigInteger('id_section');
            $table->text('question');
            $table->integer('position');

            $table->foreign('id_section')->references('id_section')->on('specification_sections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Specification_Questions');
    }
};
