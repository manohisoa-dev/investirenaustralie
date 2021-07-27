<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    
    public function scopeNbDayEndApl(){
        return $this::where('name','=','nb_day_end_apl')->first()->value;
    }

}
