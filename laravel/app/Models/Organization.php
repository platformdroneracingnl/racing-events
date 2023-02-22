<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function event(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
