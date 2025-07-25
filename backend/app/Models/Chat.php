<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AI_model;

class Chat extends Model
{
    /** @use HasFactory<\Database\Factories\ChatsFactory> */
    use HasFactory;

    protected $primaryKey = 'id_chat';
    public $timestamps = true;

    protected $fillable = [
        'id_model',
        'chat_name',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function model()
    {
        return $this->belongsTo(AI_model::class, 'id_model');
    }

    public function userChats()
    {
        return $this->hasMany(ChatUser::class, 'id_chat');
    }
}
