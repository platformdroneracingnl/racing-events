<?php

namespace App\Http\Controllers\Pilots;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Waiver;
use App\Models\Event;
use App\Models\User;
use Auth;

class RegistrationController extends Controller
{

    /**
     * Get all the registrations only for specific pilot
     */
    public function myRegistrationsIndex() {
        $registrations = User::with('registrations')->find(Auth::user()->id);
        return view('backend.pilots.registrations')
            ->with('registrations', $registrations);
    }

    /**
     * Store a newly created registration in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $eventID) {
        // Create new registration
        $registration = new Registration();
        $registration->reg_id       = uniqid();
        $registration->event_id     = $eventID;
        $registration->user_id      = Auth::user()->id;

        // Create new waiver record
        $waiver = new Waiver();
        $waiver->user_id            = $registration->user_id;
        $waiver->event_id           = $eventID;
        $waiver->registration_id    = $registration->reg_id;
        $waiver->option_1           = $this->setBoolean($request->input('waiver-opt1'));
        $waiver->option_2           = $this->setBoolean($request->input('waiver-opt2'));
        $waiver->option_3           = $this->setBoolean($request->input('waiver-opt3'));

        // Get some database rows
        $event = Event::where('id', '=', $eventID)->get();
        $organization = Organization::where('id', '=', $event->first()->organization_id)->get();
        $user = User::where('id', '=', $event->first()->user_id)->get();

        // Determine status of registration
        if($this->countRegistrations($eventID) < $event[0]->max_registrations and $event[0]->price == 0) {
            $registration->status_id = 3;
            $waitlist = false;
        } elseif($this->countRegistrations($eventID) < $event[0]->max_registrations) {
            $registration->status_id = 2;
            $waitlist = false;
        } else {
            $waittlist = true;
            $registration->status_id = 4;
        }

        $price = $event[0]->price;

        // Mollie Payment part
        // if ($event[0]->mollie_payments == 1) {
        //     // Create Mollie payment
        //     $payment = Mollie::api()->payments()->create([
        //         'amount' => [
        //             'currency' => 'EUR', // Type of currency you want to send
        //             'value' => (string) number_format($price, 2, '.', ' '), // You must send the correct number of decimals, thus we enforce the use of strings
        //         ],
        //         'description' => 'Payment for PDRNL',
        //         'redirectUrl' => route('payment.handle', ['regID' => Crypt::encrypt($registration->reg_id)]),
        //         'webhookUrl' => route('webhooks.mollie'),
        //     ]);
    
        //     $payment = Mollie::api()->payments()->get($payment->id);
        //     $registration->payment_id = $payment->id;
        // }

        try {
            if (Registration::where(['user_id' => $registration->user_id, 'event_id' => $registration->event_id])->exists()) {
                alert()->error(trans('sweetalert.already-signed-up-title'),trans('sweetalert.already-signed-up-text'));
                return redirect()->back();
            } elseif (empty(Auth::user()->country) or empty(Auth::user()->pilot_name)) {
                alert()->error(trans('sweetalert.error-signed-up-title'),trans('sweetalert.error-signed-up-text'))->autoClose(10000);
                return redirect()->back();
            } else {
                // Save registration
                $registration->save();
                // Save waiver
                $waiver->save();

                // Show Sweetalert, but wich one?
                if($waitlist == true) {
                    // Show waitlist alert
                    alert()->success(trans('sweetalert.waitlist-title'),trans('sweetalert.waitlist-text'));
                    return redirect()->route('dashboard');
                } elseif ($event[0]->mollie_payments == 1) {
                    // redirect customer to Mollie checkout page
                    return redirect($payment->getCheckoutUrl(), 303);
                } else {
                    // Show normal alert
                    alert()->success(trans('sweetalert.success-signed-up-title'),trans('sweetalert.success-signed-up-text'));
                    // Send email to pilot
                    Mail::to(Auth::user()->email)->send(new NewEventRegistration($registration, $event, $organization, $user));
                    return redirect()->route('dashboard');
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Count functie per event
     */
    public static function countRegistrations($eventID) {
        $registrations = Registration::where('event_id',$eventID)->count();
        return $registrations;
    }
}
