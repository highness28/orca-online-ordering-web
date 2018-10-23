<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";

    protected $fillable = [
        'address_book_id',
        'customer_id',
        'tracking_number',
        'total'
    ];

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

    public function deliveryAddress() {
        return $this->hasOne('App\AddressBook', 'id', 'address_book_id');
    }
}
