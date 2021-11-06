<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Registration;

class CountController extends Controller
{
    public static function getTotalEvents() {
        $eventList = Event::all();
        $eventCount = count($eventList);
        return $eventCount;
    }

    public static function getTotalUsers() {
        $usersList = User::get()->where("email_verified_at", "!=", null);
        $usersCount = count($usersList);
        return $usersCount;
    }

    public static function getTotalRegistrations() {
        $registrationList = Registration::all();
        $registrationCount = count($registrationList);
        return $registrationCount;
    }
}
