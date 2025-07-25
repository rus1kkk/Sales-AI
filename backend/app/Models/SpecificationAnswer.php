<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationAnswer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_answer';
    public $timestamps = true;

    protected $fillable = [
        'id_document',
        'id_question',
        'answer',
        'answer_formatted',
    ];

    public function question()
    {
        return $this->belongsTo(SectionQuestion::class, 'id_question', 'id_question');
    }
}
