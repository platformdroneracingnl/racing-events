<?php

namespace App\Http\Controllers\Organizator;

use App;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Status;
use app\Models\User;
use App\Notifications\ChangeEventRegistration;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use PDF;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:event-read|event-create|event-update|event-delete|event-registration|event-checkin', ['only' => ['eventRegistrations', 'exportPDF']]);
        $this->middleware('permission:event-delete', ['only' => ['destroyRegistration']]);
        $this->middleware('permission:event-registration', ['only' => ['changeMultipleRegistration', 'updateRegistration']]);
        $this->middleware('permission:event-checkin', ['only' => ['checkin', 'updateCheckin', 'scan']]);
    }

    /**
     * Get list registrations from specific event
     */
    public function eventRegistrations($eventID): View
    {
        $lang = App::getLocale();
        // $agent = new Agent();
        $result = Registration::with('user')->get()->where('event_id', $eventID);
        $event = Event::with('registration')->find($eventID);
        $registrationStatus = Status::all();

        return view('backend.organizator.events.registrations', compact('event', 'registrationStatus', 'lang'))
            ->with(['registrations' => $result]);
    }

    /**
     * Destroy a drone pilot registration
     */
    public function destroyRegistration(Registration $registration)
    {
        try {
            $registration->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Browser QR Code scan page
     */
    public function scan(): View
    {
        return view('backend.organizator.scan');
    }

    /**
     * Check-in of drone pilots
     */
    public function checkin($registrationID): View
    {
        $registration = Registration::where('reg_id', $registrationID)->get()->first();

        if (Auth::user()->id == $registration->event->user_id) {
            return view('backend.organizator.events.checkin', compact('registration'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the data during a checkin of the drone pilots with QR code
     */
    public function updateCheckin(Request $request, Registration $registration)
    {
        $failsafe = $this->setBoolean($request->input('failsafe'));
        $vtx_power = $this->setBoolean($request->input('vtx_power'));

        // Update only above 2
        $registration->update(['failsafe' => $failsafe, 'vtx_power' => $vtx_power]);

        try {
            // En nu de rest updaten mocht dat nodig zijn
            // $registration->update($request->except(['failsafe','vtx_power','_token','_method']));
            if ($failsafe && $vtx_power == 1) {
                alert()->success(trans('sweetalert.success_check_in_title'), trans('sweetalert.success_check_in_text'));
            } else {
                alert()->warning(trans('sweetalert.error_check_in_title'), trans('sweetalert.error_check_in_text'));
            }

            return redirect()->route('event.scan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Update a user registration
     */
    public function updateRegistration(Request $request, Registration $registration)
    {
        $failsafe = $this->setBoolean($request->input('failsafe'));
        $vtx_power = $this->setBoolean($request->input('vtx_power'));

        // Find event information for notification data
        $event = Event::where('id', $registration->event_id)->first();
        $user = User::where('id', $registration->user_id)->get();
        $status = Status::where('id', $request->input('status_id'))->first();

        // Update only above 2 booleans
        $registration->update(['failsafe' => $failsafe, 'vtx_power' => $vtx_power]);

        try {
            $registration->update($request->except(['failsafe', 'vtx_power', '_token', '_method']));

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
    public function changeMultipleRegistration(Request $request)
    {
        // dd($request->all());

        if (isset($request->status_id)) {
            foreach ($request->registrations as $item) {
                $registration = Registration::where('reg_id', $item)->first();
                $user = User::where('id', '=', $registration->user_id)->first();
                $event = Event::where('id', $registration->event_id)->first();
                $status = Status::where('id', '=', $request->status_id)->first();

                try {
                    $registration->update(['status_id' => $request->status_id]);
                    // Send notification to users
                    Notification::send($user, new ChangeEventRegistration($event, $status, route('registrations.index')));
                } catch (\Throwable $th) {
                    dd($th);
                }
            }

            return redirect()->back();
        } else {
            // if there is no status_id
            alert()->warning('Oeps daar ging wat fout', 'Je hebt geen status opgegeven');

            return redirect()->back();
        }
    }

    /**
     * Export drone pilots list of match to PDF
     */
    public function exportPDF(Event $event)
    {
        // Get variables
        $registrations = Registration::with('user')->get()->where('event_id', $event->id);

        // Generate PDF and download
        $pdf = PDF::loadView('backend.organizator.events.export-pdf', compact('registrations', 'event'))->setPaper('a4', 'landscape');
        // return view('backend.organizator.events.export-pdf', compact('registrations', 'event'));
        return $pdf->download($event->name.'-wedstrijd-export.pdf');
    }

    /**
     * Count functie per event
     */
    public static function countRegistrations($eventID)
    {
        return Registration::where('event_id', $eventID)->count();
    }

    /**
     * Check is user has already a registration for this competiion
     */
    public static function checkRegistration($eventID)
    {
        $registration = Registration::all()->where('event_id', $eventID)->where('user_id', Auth::user()->id)->count();
        if ($registration < 1) {
            return false;
        }

        return true;
    }
}
