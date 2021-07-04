<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Models\Location;

class Event extends Model {

    use HasFactory;
    use Searchable;

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
        'category',
        'price',
        'max_registrations',
        'date',
        'organization_id',
        'start_registration',
        'end_registration',
        'location_id',
    ];

    protected $dates = ['start_registration','end_registration','date'];

    public function location() {
        return $this->hasOne('App\Models\Location');
    }

    public function registration() {
        return $this->hasMany('App\Models\Registration');
    }

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function organization() {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function searchableAs() {
        return 'events';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
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