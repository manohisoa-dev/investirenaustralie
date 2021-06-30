<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerBusiness extends Model
{
    protected $table = 'seller_business';
    
    protected $fillable=[
        'id',
        'user_id',
        'business_name',
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
