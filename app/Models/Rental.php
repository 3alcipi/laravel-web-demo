<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    /** @use HasFactory<\Database\Factories\RentalFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'price_per_day',
        'total_price',
        'status',
        'payment_method',
        'transaction_id',
        'manual_price'
    ];
}


