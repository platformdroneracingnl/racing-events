<?php

namespace App\Http\Controllers\Pilots;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Count functie per event
     */
    public static function countRegistrations($eventID) {
        $registrations = Registration::where('event_id',$eventID)->count();
        return $registrations;
    }
}
