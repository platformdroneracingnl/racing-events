<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model {

    use HasFactory;

    protected $table = 'event_registrations';
    protected $primaryKey = 'reg_id';
    protected $keyType = 'string';
    
    protected $fillable = ['user_id', 'event_id', 'status_id', 'failsafe', 'vtx_power'];

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function event() {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    public function status() {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }

    public function waiver() {
        return $this->hasOne('App\Models\Waiver', 'registration_id', 'reg_id');
    }
}