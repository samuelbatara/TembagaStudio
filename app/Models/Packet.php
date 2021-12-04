<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Packet extends Model
{
    use HasFactory;
    protected $table ="packets";
    protected $primaryKey = "packet_id";
    public $timestamps = false;
    protected $fillable = [
        'name', 
        'price',
    ];
    
}
