<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerIndividual extends Model
{
    protected $table = 'seller_individual';

    protected $fillable=[
        'id',
        'user_id',
        'last_name',
        'first_name',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'street_adr',
        'suburb',
        'city',
        'post_code',
        'state',
        'country',
        'phone',
        'mobile',
        'email_adr',
    ];

    /**
     * An user can have any info
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        // return $this->belongsTo(User::class,'id','user_id');
    }
}
