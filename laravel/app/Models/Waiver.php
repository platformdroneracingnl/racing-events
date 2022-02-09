<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiver extends Model
{
    use HasFactory;

    protected $table = 'waivers';

    public function registration()
    {
        return $this->belongsTo(\App\Models\Registration::class);
    }

    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }

    public function event()
    {
        return $this->hasOne(\App\Models\Event::class, 'id', 'event_id');
    }
}
