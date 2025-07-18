<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'id_chat',
        'id_user',
        'message_text',
        'message_type',
        'timestamp',
    ];
}
