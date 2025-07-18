<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    /** @use HasFactory<\Database\Factories\ChatUserFactory> */
    use HasFactory;

    protected $table = 'chats_users';

    public $incrementing = false;
    protected $primaryKey = ['id_chat', 'id_user'];
    protected $keyType = 'array';
}
