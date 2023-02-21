<?php

namespace App\Http\Controllers\Organizator;

use App;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\GoogleCalendarController;
use App\Models\Event;
use App\Models\Location;
use App\Models\Registration;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Image;
use Jenssegers\Agent\Agent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('permission:event-read|event-create|event-update|event-delete|event-registration|event-checkin', ['only' => ['index', 'show']]);
        // $this->middleware('permission:event-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:event-update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:event-delete', ['only' => ['destroy']]);
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Shows list of all own made events.
     */
    public function index(): View
    {
        $lang = App::getLocale();
        $events = User::with('events')->find(Auth::user()->id);

        return view('backend.organizator.events.index', compact('events', 'lang'));
    }

    /**
     * Display the specified resource.
     */
    // Show specific event
    public function show(Event $event): View
    {
        $agent = new Agent();
        // All registrations with a status of 3
        $complete_reg = Registration::with('user')->get()->where('event_id', $event->id)->where('status_id', 3)->count();
        // All registrations that have everything except status 3
        $pending_reg = Registration::with('user')->get()->where('event_id', $event->id)->count();
        // Price calculation
        $price_total = ($event->price * $pending_reg);
        $price_subtotal = ($event->price * $complete_reg);

        return view('backend.organizator.events.show', compact('event', 'agent', 'complete_reg', 'pending_reg', 'price_total', 'price_subtotal'));
    }

    /**
     * Show the page for creating a new event.
     */
    public function create(): View
    {
        $locations = Location::all();

        return view('backend.organizator.events.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Make new event object
        $event = new Event();

        $event->online = $this->setBoolean($request->input('online'));
        $event->registration = $this->setBoolean($request->input('registration'));
        $event->waitlist = $this->setBoolean($request->input('waitlist'));
        $event->mollie_payments = $this->setBoolean($request->input('mollie_payments'));
        $event->google_calendar = $this->setBoolean($request->input('google_calendar'));

        $event->user_id = Auth::user()->id;
        $event->organization_id = Auth::user()->organization;
        $event->email = $request->input('email');
        $event->name = $request->input('name');
        $event->category = $request->input('category');
        $event->date = $request->input('date');
        $event->max_registrations = $request->input('max_registrations');
        $event->location_id = $request->input('location_id');
        $event->start_registration = $request->input('start_registration');
        $event->end_registration = $request->input('end_registration');
        $event->price = $request->input('price');
        $event->description = $request->input('description');
        $event->docs_link = $request->input('docs_link');

        // Save the uploaded image
        if ($request->has('image')) {
            $image = strtolower($request->input('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $storage_image = Image::make($request->image)->resize(null, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
            $storage_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/events/'.$filename, $storage_image, 'public');
            $event->image = $filename;
        }

        // No price for event means free, turn mollie always off!
        if ($event->price == null || 0) {
            $event->price = 0;
            $event->mollie_payments = 0;
        }

        try {
            $event->save();
            if ($event->google_calendar == 1) {
                GoogleCalendarController::createCalendarEvent($event);
            }

            return redirect()->route('organizator.events.index')
                ->with('success', 'Event succesvol aangemaakt');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $locations = Location::all();

        return view('backend.organizator.events.edit', compact('event', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        // Valide input
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,svg',
        ]);

        $online = $this->setBoolean($request->input('online'));
        $registration = $this->setBoolean($request->input('registration'));
        $waitlist = $this->setBoolean($request->input('waitlist'));
        $mollie_payments = $this->setBoolean($request->input('mollie_payments'));
        $google_calendar = $this->setBoolean($request->input('google_calendar'));

        if ($request->has('image')) {
            // Remove old image if exist
            $this->deleteOldImage('events', $request->input('oldImage'));

            // Save the new uploaded image
            $image = strtolower($request->input('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $storage_image = Image::make($request->image)->resize(null, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
            $storage_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/events/'.$filename, $storage_image, 'public');
            $event->update(['image' => $filename]);
        }

        // No price for event means free, turn mollie always off!
        if ($event->price == null || 0) {
            $event->price = 0;
            $mollie_payments = 0;
        }

        // Only update the input booleans
        $event->update(['online' => $online, 'registration' => $registration, 'waitlist' => $waitlist, 'mollie_payments' => $mollie_payments, 'google_calendar' => $google_calendar]);

        try {
            // En nu de rest updaten mocht dat nodig zijn
            $event->update($request->except(['online', 'registration', 'waitlist', 'mollie_payments', 'google_calendar', 'image']));
            // if ($google_calendar == 1 and $event->google_calendar_id == null) {
            //     // Create new Google Event
            //     GoogleCalendarController::createCalendarEvent($event);
            // } elseif ($google_calendar == 0 and $event->google_calendar_id != null) {
            //     // Delete Google Event
            //     GoogleCalendarController::deleteCalendarEvent($event);
            // } else {
            //     // Update Google Event
            //     GoogleCalendarController::changeCalendarEvent($event);
            // }
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('organizator.events.index')
            ->with('success', 'Event succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        if ($event->google_calendar_id != null) {
            // Delete Google Event
            GoogleCalendarController::deleteCalendarEvent($event);
        }
        // Delete event and related objects
        $this->deleteOldImage('events', $event->image);
        $event->delete();

        return redirect()->route('organizator.events.index')
            ->with('success', 'Event succesvol verwijderd');
    }
}
