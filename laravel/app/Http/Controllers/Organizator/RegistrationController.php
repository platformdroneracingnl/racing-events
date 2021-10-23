<?php

namespace App\Http\Controllers\Organizator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Status;
use App\Models\Event;
use Auth;
use App;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:event-list|event-create|event-edit|event-delete|event-registration|event-checkin', ['only' => ['registrations','exportPDF']]);
        $this->middleware('permission:event-delete', ['only' => ['destroyRegistration']]);
        $this->middleware('permission:event-registration', ['only' => ['changeMultipleRegistration','updateRegistration']]);
        $this->middleware('permission:event-checkin', ['only' => ['checkin','updateCheckin']]);
    }

    /**
     * Get list of drone pilots
     */
    public function index($eventID) {
        $lang = App::getLocale();
        // $agent = new Agent();
        $result = Registration::with('user')->get()->where('event_id', $eventID);
        $event = Event::with('registration')->find($eventID);
        $registrationStatus = Status::all();

        return view('backend.organizator.events.registrations', compact('event','registrationStatus','lang'))
            ->with(['registrations' => $result]);
    }

    /**
     * Count functie per event
     */
    public static function countRegistrations($eventID) {
        $registrations = Registration::where('event_id',$eventID)->count();
        return $registrations;
    }

    /**
     * Check is user has already a registration for this competiion
     */
    public static function checkRegistration($eventID) {
        $registration = Registration::all()->where('event_id',$eventID)->where('user_id',Auth::user()->id)->count();
        if($registration < 1) {
            return false;
        } else {
            return true;
        }
    }
}
