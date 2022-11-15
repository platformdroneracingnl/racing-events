<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'latitude', 'longitude', 'name', 'street', 'house_number', 'zip_code', 'city', 'province', 'country_id', 'category', 'image', 'description',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Relation with event table
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relation with country table
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
