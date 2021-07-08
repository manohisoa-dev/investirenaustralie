<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgrammeTranslation extends Model
{
    protected $fillable=[
        'id',
        'programme_id',
        'translation_id',
    ];
}
