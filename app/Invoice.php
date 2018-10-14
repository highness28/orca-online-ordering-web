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
}
