<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceTeam extends Model
{
    use HasFactory;

    protected $table = 'race_teams';
    protected $fillable = [
        'name',
        'image',
        'description',
    ];

    /**
     * Relationships
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
