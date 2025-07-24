<?php

namespace App\Http\Controllers;

use App\Models\SpecificationDocument;
use App\Models\SpecificationSection;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function show($chatId)
    {
        $document = SpecificationDocument::where('id_chat', $chatId)->latest()->first();
        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        // Секции для запроса 
        $sections = [
            'problem' => 'Problem',
            'solution' => 'Solution',
            'product' => 'Product Advantages',
            'stages' => 'Stages',
            'price' => 'Price'
        ];

        $result = [];
        foreach ($sections as $key => $title) {
            // Получаем секцию
            $section = SpecificationSection::where('title', $title)->first();

            if ($section) {
                // Получаем вопросы для секции
                $questions = \DB::table('section_questions')
                    ->where('id_section', $section->id_section)
                    ->get();

                $items = [];
                $description = null;
                $caption = null;

                foreach ($questions as $question) {
                    // Получаем ответ для этого вопроса и документа
                    $answer = \DB::table('specification_answers')
                        ->where('id_question', $question->id_question)
                        ->where('id_document', $document->id_document)
                        ->first();

                    if ($answer) {
                        // Определяем тип данных
                        if (str_contains($question->question, 'description')) {
                            $description = $answer->answer_formatted;
                        } elseif (str_contains($question->question, 'caption')) {
                            $caption = $answer->answer_formatted;
                        } else {
                            // Обычный пункт
                            $items[] = $answer->answer_formatted;
                        }
                    }
                }

                $result[$key] = [
                    'title' => $section->title,
                    'description' => $description,
                    'items' => $items,
                    'caption' => $caption
                ];
            }
        }

        return response()->json($result);
    }
}