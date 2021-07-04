<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    use HasFactory;

    protected $table = 'locations';
    protected $fillable = [
        'latitude', 'longitude', 'name', 'street', 'house_number', 'zip_code', 'city', 'province', 'country', 'comment'
    ];

    // Relation with event table
    public function event() {
        return $this->belongsTo('App\Models\Event');
    }
}