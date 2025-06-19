<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /** @use HasFactory<\Database\Factories\PricesFactory> */
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'price_day',
        'used',
        'status'
    ];

    protected $casts = [
        'used' => 'boolean'
    ];

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
