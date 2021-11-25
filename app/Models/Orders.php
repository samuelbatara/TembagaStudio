<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $primaryKey = "order_id";
    protected $fillable = [
        'name',
        'phone',
        'email',
        'time',
        'studio_id',
        'duration',
        'status',
    ];
}
