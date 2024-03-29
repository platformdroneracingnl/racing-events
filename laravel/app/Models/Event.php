<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'user_id',
        'email',
        'name',
        'description',
        'docs_link',
        'online',
        'registration',
        'mollie_payments',
        'waitlist',
        'google_calendar',
        'category',
        'price',
        'max_registrations',
        'date',
        'organization_id',
        'start_registration',
        'end_registration',
        'location_id',
        'image',
    ];

    protected $casts = [
        'start_registration' => 'datetime',
        'end_registration' => 'datetime',
        'date' => 'datetime',
    ];

    public function location(): HasOne
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function registration(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function organization(): HasOne
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    /**
     * Get the index name for the model.
     */
    public function searchableAs(): string
    {
        return 'events';
    }

    /**
     * Get the indexable data array for the model.
     */
    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        $data = [
            'name' => $array['name'],
            'online' => $array['online'], // Never delete because of filter
            'organization' => Organization::with('event')->where('id', $array['organization_id'])->first(),
            'location' => Location::with('event')->where('id', $array['location_id'])->first(),
        ];

        return $data;
    }
}
