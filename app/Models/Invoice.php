<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'id',
        'order_id',
        'invoice_num'
    ];

    public $timestamps = false;
}
