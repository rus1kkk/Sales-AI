<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionQuestion extends Model
{
    /** @use HasFactory<\Database\Factories\SectionQuestionFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_question';

    public function section()
    {
        return $this->belongsTo(SpecificationSection::class, 'id_section', 'id_section');
    }
}
