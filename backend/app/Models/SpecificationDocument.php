<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationDocument extends Model
{
    /** @use HasFactory<\Database\Factories\SpecificationDocumentFactory> */
    use HasFactory;

    protected $table = 'specification_documents';

    protected $primaryKey = 'id_document';

    public $timestamps = true;

    protected $fillable = [
        'id_chat',
        'version',
    ];
}
