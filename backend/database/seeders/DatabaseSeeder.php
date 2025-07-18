<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use App\Models\Payment;
use App\Models\SectionQuestion;

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
    }
}
