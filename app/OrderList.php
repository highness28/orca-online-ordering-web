<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $table = 'orders_list';

    public function product() {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
