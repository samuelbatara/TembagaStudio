<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = "payment_id";
    protected $table ="payments";
    protected $fillable = [ 
        'order_id',
        'status_code',
        'amount',
        'time',
    ];
}
