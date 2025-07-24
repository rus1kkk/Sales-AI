<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use App\Models\Payment;
use App\Models\SectionQuestion;
use App\Models\SpecificationAnswer;
use App\Models\SpecificationDocument;
use App\Models\SpecificationSection;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем 10 пользователей
        User::factory(10)->create()->each(function ($user) {
            // Для каждого пользователя создаём чат
            $chat = Chat::factory()->create();

            // Связь пользователь - чат
            ChatUser::factory()->create([
                'id_chat' => $chat->id_chat,
                'id_user' => $user->id_user,
            ]);

            // Сообщения в чат
            Message::factory(3)->create([
                'id_chat' => $chat->id_chat,
                'id_user' => $user->id_user,
            ]);

            // Платёж
            Payment::factory()->create([
                'id_user' => $user->id_user,
            ]);
        });

        // Вопросы к секциям
        SectionQuestion::factory(10)->create();

        $aiModel = \App\Models\AI_model::create([
            'model_name' => 'default',
            'model_fullname' => 'Базовая модель',
            'model_info' => 'Стандартная модель для чатов'
        ]);

        $chat = Chat::create([
            'model_name' => $aiModel->model_name,
            'chat_name' => 'Основной чат',
            'chat_status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ChatUser::create([
            'id_chat' => $chat->id_chat,
            'id_user' => User::first()->id_user,
            'timestamp' => now()
        ]);

        $document = SpecificationDocument::create([
            'id_chat' => $chat->id_chat,
            'version' => 'v1',
            'created_at' => now(),
        ]);

        $sections = [
            'problem' => [
                'title' => 'Problem',
                'description' => 'Many businesses lose customers without a website.',
                'subtitle' => 'Main problems without a website:',
                'items' => [
                    'Dependence on marketplaces or Instagram',
                    'Hard to showcase the full product range',
                    'No way to track orders and analyze sales',
                ],
                'caption' => 'We offer a solution that will remove these limitations.'
            ],
            'solution' => [
                'title' => 'Solution',
                'description' => 'We will create a website that makes selling easy:',
                'items' => [
                    'Catalog with filters (size, brand, price)',
                    'Convenient cart and checkout',
                    'Mobile version - works perfectly on phones',
                    'Fast performance and intuitive design',
                    'Ready for online payments and CRM integration',
                ],
                'caption' => 'Simple as: visit, find, buy. Easy for you to manage.'
            ],
            'advantages' => [
                'title' => 'Advantages',
                'items' => [
                    'Sells 24/7',
                    'Higher trust than social media accounts',
                    'Ability to run ads and track what works',
                    'Ready for online payments and CRM integration',
                    'Saves time - less manual order processing',
                ],
                'caption' => 'This is not just a website - it\'s a full-fledged sales tool.'
            ],
            'stages' => [
                'title' => 'Stages',
                'items' => [
                    'Discuss your needs and products',
                    'Design creation',
                    'Development',
                    'Testing',
                    'Launch',
                ],
                'caption' => 'Clear process from start to finish.'
            ],
            'price' => [
                'title' => 'Price',
                'description' => 'Cost depends on catalog size and required features. Approximate price: from 120,000 to 180,000 ₽',
                'subtitle' => 'Includes:',
                'items' => [
                    'Design',
                    'Mobile adaptation',
                    'Installation and basic setup',
                    'Cart, filters, delivery integration',
                ],
                'caption' => 'Payment by stages, official contract.'
            ],
            'product' => [
                'title' => 'Product Advantages',
                'items' => [
                    'Sells 24/7 without staff involvement',
                    'Higher conversion than social media',
                    'Built-in analytics and reporting',
                    'Mobile-optimized for all devices',
                    'Secure payment integrations'
                ],
                'caption' => 'More than just a website - a full sales ecosystem'
            ],
            'team' => [
                'title' => 'Team',
                'subtitle' => 'Project team:',
                'items' => [
                    'Designer',
                    'Frontend and backend developer',
                    'UX specialist',
                    'Project manager always available',
                ],
                'caption' => 'We have experience with e-commerce and know how to make websites that drive sales.'
            ]
        ];

        foreach ($sections as $sectionTitle => $sectionData) {
            $section = SpecificationSection::create([
                'title' => $sectionData['title']
            ]);

            // Основные пункты
            foreach ($sectionData['items'] as $i => $item) {
                $question = SectionQuestion::create([
                    'id_section' => $section->id_section,
                    'question' => $sectionTitle . ' item ' . ($i + 1),
                    'position' => $i + 1
                ]);

                SpecificationAnswer::create([
                    'id_document' => $document->id_document,
                    'id_question' => $question->id_question,
                    'answer' => $item,
                    'answer_formatted' => $item
                ]);
            }

            // Описание (description)
            if (isset($sectionData['description'])) {
                $question = SectionQuestion::create([
                    'id_section' => $section->id_section,
                    'question' => $sectionTitle . ' description',
                    'position' => 100
                ]);
                SpecificationAnswer::create([
                    'id_document' => $document->id_document,
                    'id_question' => $question->id_question,
                    'answer' => $sectionData['description'],
                    'answer_formatted' => $sectionData['description']
                ]);
            }

            // Подпись (caption)
            if (isset($sectionData['caption'])) {
                $question = SectionQuestion::create([
                    'id_section' => $section->id_section,
                    'question' => $sectionTitle . ' caption',
                    'position' => 101
                ]);
                SpecificationAnswer::create([
                    'id_document' => $document->id_document,
                    'id_question' => $question->id_question,
                    'answer' => $sectionData['caption'],
                    'answer_formatted' => $sectionData['caption']
                ]);
            }
        }
    }
}
