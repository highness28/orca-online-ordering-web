<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $table = 'orders_list';
    
    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'subtotal',
        'reviewed'
    ];

    public function product() {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
