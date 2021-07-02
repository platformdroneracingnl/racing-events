<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';
    protected $fillable = [
        'name', 'short_name', 'image',
    ];

    /**
     * Relationships
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
