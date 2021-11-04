<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reglage extends Model
{
    protected $table = 'reglages';

    protected $fillable = [
        'id',
        'code',
        'seuil_name',
        'seuil_value',
        'seuil_unite',
    ];

    public $timestamps = false;
}
