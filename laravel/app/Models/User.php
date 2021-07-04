<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Internetcode\LaravelUserSettings\Traits\HasSettingsTrait;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasSettingsTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'pilot_name',
        'date_of_birth',
        'country',
        'phonenumber',
        'image',
        'organization',
        'race_team',
        'suspended_until',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_of_birth',
        'suspended_until',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function country() {
        return $this->hasOne('App\Models\Country', 'id', 'country');
    }

    public function organization() {
        return $this->hasOne('App\Models\Organization');
    }
}
