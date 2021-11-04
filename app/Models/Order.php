<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'doss_trans_id',
        'final_sales_price',
        'commission_type',
        'taux_commission',
        'montant_bonus', 
        'montant_init_deposit',
        'date_init_deposit_confirm',
        'cpc_invoice_first_pmt',
        'date_second_pmt',
        'montant_second_pmt',
        'cpc_invoice_second_pmt',
        'date_pmt_bonus',
        'cpc_invoice_bonus',
    ];

    public $timestamps = false;

}
