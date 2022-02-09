<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'event_registrations';

    protected $primaryKey = 'reg_id';

    protected $keyType = 'string';

    protected $fillable = ['user_id', 'event_id', 'status_id', 'failsafe', 'vtx_power'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'event_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function waiver()
    {
        return $this->hasOne(Waiver::class, 'registration_id', 'reg_id');
    }
}
