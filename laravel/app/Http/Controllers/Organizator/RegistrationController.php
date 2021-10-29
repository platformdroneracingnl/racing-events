<?php

namespace App\Http\Controllers\Organizator;

use App\Http\Controllers\Controller;
use App\Notifications\ChangeEventRegistration;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Organization;
use App\Models\Country;
use App\Models\Status;
use app\Models\User;
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
     * Check-in of drone pilots
     */
    public function checkin($registrationID) {
        $registration = Registration::where('reg_id', $registrationID)->get()->first();

        if(Auth::user()->id == $registration->event->user_id) {
            return view('backend.organizator.events.checkin', compact('registration'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the data during a checkin of the drone pilots with QR code
     */
    public function updateCheckin(Request $request, Registration $registration) {
        $failsafe   = $this->setBoolean($request->input('failsafe'));
        $vtx_power  = $this->setBoolean($request->input('vtx_power'));

        // Update only above 2
        $registration->update(array('failsafe' => $failsafe, 'vtx_power' => $vtx_power));

        try {
            // En nu de rest updaten mocht dat nodig zijn
            // $registration->update($request->except(['failsafe','vtx_power','_token','_method']));
            if ($failsafe and $vtx_power == 1) {
                alert()->success(trans('sweetalert.success_check_in_title'),trans('sweetalert.success_check_in_text'));
            } else {
                alert()->warning(trans('sweetalert.error_check_in_title'),trans('sweetalert.error_check_in_text'));
            }
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Update a user registration
     */
    public function updateRegistration(Request $request, Registration $registration) {
        $failsafe   = $this->setBoolean($request->input('failsafe'));
        $vtx_power  = $this->setBoolean($request->input('vtx_power'));

        // Find event information for notification data
        $event = Event::where('id', $registration->event_id)->first();
        $user = User::where('id', $registration->user_id)->get();
        $status = Status::where('id', $request->input('status_id'))->first();

        // Update only above 2 booleans
        $registration->update(array('failsafe' => $failsafe, 'vtx_power' => $vtx_power));

        try {
            $registration->update($request->except(['failsafe','vtx_power','_token','_method']));

            // Determine wich sweetalart you get
            // if ($failsafe and $vtx_power == 1) {
            //     alert()->success(trans('sweetalert.success_check_in_title'),trans('sweetalert.success_check_in_text'));
            // } else {
            //     alert()->warning(trans('sweetalert.error_check_in_title'),trans('sweetalert.error_check_in_text'));
            // }
            // Send notification to user
            Notification::send($user, new ChangeEventRegistration($event, $status, route('registrations.index')));
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Change a registration for multiple persons
     */
    public function changeMultipleRegistration(Request $request) {
        // dd($request->all());

        if (isset($request->status_id)) {
            foreach ($request->registrations as $item) {

                $registration = Registration::where('reg_id', $item)->first();
                $user = User::where('id', '=', $registration->user_id)->first();
                $event = Event::where('id', $registration->event_id)->first();
                $status = Status::where('id','=', $request->status_id)->first();

                try {
                    $registration->update(array('status_id' => $request->status_id));
                    // Send notification to users
                    Notification::send($user, new ChangeEventRegistration($event, $status, route('registrations.index')));
                } catch (\Throwable $th) {
                    dd($th);
                }
            }
            return redirect()->back();
        } else {
            // if there is no status_id
            alert()->warning("Oeps daar ging wat fout","Je hebt geen status opgegeven");
            return redirect()->back();
        }
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
