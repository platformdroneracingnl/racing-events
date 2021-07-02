<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raceteam extends Model
{
    use HasFactory;

    protected $table = 'raceteams';
    protected $fillable = [
        'name',
        'image',
        'description',
    ];

    /**
     * Relationships
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
