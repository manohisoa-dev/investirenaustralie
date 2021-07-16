<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationMembreApl extends Model {
    protected $table = 'relation_membre_apl';

    public function Users() {
        return $this->belongsTo(User::class,'apl_id','id');
    }
}
