<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Packet;

class Order extends Model
{
    use HasFactory;
    protected $table ="orders";
    protected $primaryKey='order_id';
    protected $fillable = [
        'order_id',
        'name', 
        'phone',
        'email',
        'time',
        'packet_id',
        'duration',
        'status',
    ];
}
