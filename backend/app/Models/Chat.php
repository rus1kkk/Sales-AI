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
    public $timestamps = false;

    protected $fillable = [
        'id_model',
        'chat_name',
        'status',
        'timestamp'
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    public function model()
    {
        return $this->belongsTo(AI_model::class, 'id_model');
    }
}
