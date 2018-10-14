<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    protected $table = 'address_book';

    protected $fillable = [
        'delivery_address',
        'province',
        'city',
        'barangay',
        'phone_number',
        'customer_id'
    ];
}
