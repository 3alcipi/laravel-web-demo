<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;
    protected $fillable = [
        'plate',
        'model',
        'type_id',
        'brand_id',
        'color',
        'year',
        'engine_number',
        'chassis_number',
        'transmission',
        'seats',
        'fuel',
        'description',
        'image_patch',
        'status'
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
