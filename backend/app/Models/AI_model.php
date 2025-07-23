<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AI_model extends Model
{
    /** @use HasFactory<\Database\Factories\ModelFactory> */
    use HasFactory;
    protected $primaryKey = 'id_model';
    protected $table = 'models';
    public $timestamps = false;

    protected $fillable = [
        'model_name',
        'model_fullname',
        'model_info'
    ];
}
