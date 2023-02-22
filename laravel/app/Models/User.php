<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Internetcode\LaravelUserSettings\Traits\HasSettingsTrait;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasSettingsTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'datetime',
        'suspended_until' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function countries(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function organization(): HasOne
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    public function race_team(): HasOne
    {
        return $this->hasOne(RaceTeam::class, 'id', 'race_team_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class)->orderBy('created_at', 'DESC');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function loginSecurity(): HasOne
    {
        return $this->hasOne(LoginSecurity::class);
    }

    public function waivers(): HasMany
    {
        return $this->hasMany(Waiver::class);
    }
}
