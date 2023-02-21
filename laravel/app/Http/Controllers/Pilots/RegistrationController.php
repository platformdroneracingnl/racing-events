<?php

namespace App\Http\Controllers\Pilots;

use App;
use App\Http\Controllers\Controller;
use App\Mail\NewEventRegistration;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Models\Waiver;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Mollie\Laravel\Facades\Mollie;

class RegistrationController extends Controller
{
    /**
     * Get all the registrations only for specific pilot
     */
    public function myRegistrationsIndex()
    {
        $lang = App::getLocale();
        $registrations = User::with('registrations')->find(Auth::user()->id);

        return view('backend.pilots.registrations.index', compact('lang', 'registrations'));
    }

    /**
     * Store a newly created registration in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        // Create new registration
        $registration = new Registration();
        $registration->reg_id = uniqid();
        $registration->event_id = $event->id;
        $registration->user_id = Auth::user()->id;

        // Create new waiver record
        $waiver = new Waiver();
        $waiver->user_id = $registration->user_id;
        $waiver->event_id = $event->id;
        $waiver->registration_id = $registration->reg_id;
        $waiver->option_1 = $this->setBoolean($request->input('waiver-opt1'));
        $waiver->option_2 = $this->setBoolean($request->input('waiver-opt2'));
        $waiver->option_3 = $this->setBoolean($request->input('waiver-opt3'));

        // Determine status of registration
        if ($this->countRegistrations($event->id) < $event->max_registrations && $event->price == 0) {
            $registration->status_id = 3;
            $waitlist = false;
        } elseif ($this->countRegistrations($event->id) < $event->max_registrations) {
            $registration->status_id = 2;
            $waitlist = false;
        } else {
            $waitlist = true;
            $registration->status_id = 4;
        }

        // Mollie Payment part
        if ($event->mollie_payments == 1) {
            // Create Mollie payment
            $payment = Mollie::api()->payments()->create([
                'amount' => [
                    'currency' => 'EUR', // Type of currency you want to send
                    'value' => (string) number_format($event->price, 2, '.', ' '), // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                'description' => 'Payment for PDRNL',
                'redirectUrl' => route('payment.handle', ['regID' => Crypt::encrypt($registration->reg_id)]),
                'webhookUrl' => route('webhooks.mollie'),
            ]);
            $payment = Mollie::api()->payments()->get($payment->id);
            $registration->payment_id = $payment->id;
        }

        try {
            if (Registration::where(['user_id' => $registration->user_id, 'event_id' => $registration->event_id])->exists()) {
                alert()->error(trans('sweetalert.already-signed-up-title'), trans('sweetalert.already-signed-up-text'));

                return redirect()->back();
            } elseif (empty(Auth::user()->country_id) || empty(Auth::user()->pilot_name)) {
                alert()->error(trans('sweetalert.error-signed-up-title'), trans('sweetalert.error-signed-up-text'))->autoClose(10000);

                return redirect()->back();
            } else {
                // Save registration and waiver
                $registration->save();
                $waiver->save();

                // Show Sweetalert, but wich one?
                if ($waitlist) {
                    // Show waitlist alert
                    alert()->success(trans('sweetalert.waitlist-title'), trans('sweetalert.waitlist-text'));

                    return redirect()->route('dashboard');
                } elseif ($event->mollie_payments == 1) {
                    // redirect customer to Mollie checkout page
                    return redirect($payment->getCheckoutUrl(), 303);
                } else {
                    // Show normal alert
                    alert()->success(trans('sweetalert.success-signed-up-title'), trans('sweetalert.success-signed-up-text'));
                    // Send email to pilot
                    Mail::to(Auth::user()->email)->send(new NewEventRegistration($registration, $event));

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
    public static function countRegistrations($eventID)
    {
        return Registration::where('event_id', $eventID)->count();
    }
}
