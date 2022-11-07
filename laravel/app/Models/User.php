<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Internetcode\LaravelUserSettings\Traits\HasSettingsTrait;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasSettingsTrait, HasRoles;

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
        'country_id',
        'phonenumber',
        'image',
        'organization_id',
        'race_team_id',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_of_birth' => 'datetime',
        'suspended_until' => 'datetime',
        'email_verified_at' => 'datetime',];

    /**
     * Relationships
     */
    public function countries()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    public function race_team()
    {
        return $this->hasOne(RaceTeam::class, 'id', 'race_team_id');
    }

    public function registrations()
    {
        return $this->hasMany(\App\Models\Registration::class)->orderBy('created_at', 'DESC');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function loginSecurity()
    {
        return $this->hasOne(\App\Models\LoginSecurity::class);
    }

    public function waivers()
    {
        return $this->hasMany(Waiver::class);
    }
}
