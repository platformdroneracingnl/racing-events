<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiver extends Model {

    use HasFactory;

    protected $table = 'waivers';

    public function registration() {
        return $this->belongsTo('App\Models\Registration');
    }

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function event() {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }
}