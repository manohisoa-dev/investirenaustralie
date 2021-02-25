<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $fillable=[
        'id',
        'first_name',
        'last_name',
        'newsletter',
        'orga_name',
        'orga_presentation',
        'orga_email',
        'orga_phone',
        'orga_website',
        'orga_operation_state',
        'orga_operation_range',
        'contact_name',
        'contact_email',
        'contact_phone',
        'crm_name',
        'crm_email',
        'bank_iban',
        'bank_bic',
        'allow_sharing',
        'user_id'
    ];


    /**
     * An user can have any info
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }

    
}
