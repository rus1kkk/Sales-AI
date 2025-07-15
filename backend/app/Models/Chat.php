<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
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
        return $this->belongsTo(AiModel::class, 'id_model');
    }
}
