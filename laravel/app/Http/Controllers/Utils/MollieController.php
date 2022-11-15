<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Mail\NewEventRegistration;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Notifications\RemoveEventRegistration;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function preparePayment()
    {
        // Onderstaand komt in de functie te hangen die een inschrijving opslaat....Wel nog VOOR dat de inschrijving word opgeslagen!
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR', // Type of currency you want to send
                'value' => '10.00', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'Payment voor PDRNL',
            'redirectUrl' => route('payment.handle', '1'), // after the payment completion where you to redirect
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        // dd($payment->getCheckoutUrl());

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * Page redirection after the payment
     *
     * @return Response
     */
    public function paymentHandler($regID)
    {
        // Decrypt variable
        $regID = Crypt::decrypt($regID);

        // Get registration data
        $registration = Registration::where('reg_id', '=', $regID)->get();

        if (isset($registration[0]->payment_id)) {
            $payment = Mollie::api()->payments->get($registration[0]->payment_id);

            // If there is still a registration
            if (isset($registration)) {
                // Get variables for email and view content
                $event = $registration[0]->event;
                $organization = $event->organization;
                $user = $event->user;

                // If payment is open then show another view and no email is sending
                if ($payment->status == 'open') {
                    $expireAt = Carbon::parse($payment->expiresAt)->diffForHumans();

                    return view('payments.open', compact('event', 'registration', 'expireAt'));
                }

                // Send email to pilot
                Mail::to(Auth::user()->email)->send(new NewEventRegistration($registration, $event, $organization, $user));
            }

            // Return payment succcesfull view
            return view('payments.success', compact('event', 'registration'));
        } else {
            // Return payment failed view
            return view('payments.failed');
        }
    }

    // Handle Mollie payments
    public function mollieHandle(Request $request)
    {
        try {
            if (! $request->has('id')) {
                return;
            }

            $payment = Mollie::api()->payments()->get($request->id);

            if ($payment->hasRefunds()) {
                // Change registration status to refunded
                $registration = Registration::where('payment_id', $request->id)->firstOrFail();
                $registration->status_id = 6;
                $registration->save();
            } elseif ($payment->isPaid()) {
                // Change registration status to paid
                $registration = Registration::where('payment_id', $request->id)->firstOrFail();
                $registration->status_id = 3;
                $registration->save();
            } elseif ($payment->isPaid() == null or $payment->status == 'expired') {
                // Remove registration if payment fails or expired
                $registration = Registration::where('payment_id', $request->id)->firstOrFail();
                // Little escape for when organizator changes the registration status
                if ($registration->status_id == 2) {
                    $registration->delete();

                    // Get extra information
                    $event = Event::where('id', '=', $registration->event_id)->get();
                    $user = User::where('id', '=', $registration->user_id)->get();

                    // Send notification to user
                    Notification::send($user, new RemoveEventRegistration($event));
                }
            }
        } catch (\Exception $e) {
            echo 'API call failed: '.htmlspecialchars($e->getMessage());
        }
    }

    // Check payment status
    public function checkPaymentStatus($paymentID)
    {
        // $paymentID = Crypt::decrypt($paymentID);
        $payment = Mollie::api()->payments()->get($paymentID);
        // dd($payment);

        if ($payment->status == 'open') {
            return redirect($payment->getCheckoutUrl(), 303);
        } else {
            // with alert
            return redirect()->back();
        }
    }

    public static function checkPaymentExpire($paymentID)
    {
        $payment = Mollie::api()->payments()->get($paymentID);
        $expireAt = Carbon::parse($payment->expiresAt)->diffForHumans();

        return $expireAt;
    }
}
