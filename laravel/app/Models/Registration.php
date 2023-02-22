<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'event_registrations';

    protected $primaryKey = 'reg_id';

    protected $keyType = 'string';

    protected $fillable = ['user_id', 'event_id', 'status_id', 'failsafe', 'vtx_power'];

    /*
    * Relationships
    */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function event(): HasOne
    {
        return $this->hasOne(Event::class, 'id', 'event_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function waiver(): HasOne
    {
        return $this->hasOne(Waiver::class, 'registration_id', 'reg_id');
    }
}
