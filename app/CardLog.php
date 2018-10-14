<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardLog extends Model
{
    protected $table = 'card_logs';

    protected $fillable = [
        'invoice_id',
        'card_number',
        'expiration',
        'cvc'
    ];
}
