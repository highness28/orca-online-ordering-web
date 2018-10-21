<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number'
    ];

    public function account () {
        return $this->hasOne('App\CustomerAccount', 'customer_id', 'id');
    }
}
