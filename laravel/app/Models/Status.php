<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model {

    use HasFactory;

    protected $table = 'registration_status';

    // Relation with registration table
    public function registration() {
        return $this->belongsTo('App\Models\Registration');
    }
}