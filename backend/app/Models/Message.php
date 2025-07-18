<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /** @use HasFactory<\Database\Factories\MessagesFactory> */
    use HasFactory;

    protected $fillable = [
        'id_chat',
        'id_user',
        'message_text',
        'message_type',
    ];
}
