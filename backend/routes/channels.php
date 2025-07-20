<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{id}', function ($user, $id) {
    // Пример простой логики: пользователь — участник чата
    return \DB::table('chats_users')
        ->where('id_chat', $id)
        ->where('id_user', $user->id_user)
        ->exists();
});