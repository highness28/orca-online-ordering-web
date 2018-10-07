<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'product_review';

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }
}
