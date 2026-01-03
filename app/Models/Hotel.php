<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'description',
        'address',
        'price_per_night',
        'rating',
        'image',
        'amenities',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'rating' => 'float',
        'amenities' => 'array',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
