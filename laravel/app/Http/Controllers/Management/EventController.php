<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\GoogleCalendarController;
use App\Models\Event;
use App\Models\Location;
use App\Models\Organization;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // $this->middleware('permission:event-read|event-create|event-update|event-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:event-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:event-update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:event-delete', ['only' => ['destroy']]);
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $lang = App::getLocale();
        $events = Event::all();

        return view('backend.management.events.index', compact('events', 'lang'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): View
    {
        return view('backend.management.events.show', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = User::all();
        $organizations = Organization::all();
        $locations = Location::all();

        return view('backend.management.events.create', compact('locations', 'users', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Valide input
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,svg',
        ]);

        // Make new event object
        $event = new Event();

        // Set the boolean options
        $event->online = $this->setBoolean($request->input('online'));
        $event->registration = $this->setBoolean($request->input('registration'));
        $event->waitlist = $this->setBoolean($request->input('waitlist'));
        $event->mollie_payments = $this->setBoolean($request->input('mollie_payments'));
        $event->google_calendar = $this->setBoolean($request->input('google_calendar'));

        // Process the basic information of the event
        $event->organization_id = $request->input('organization_id');
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

        // Determine user ID
        if ($request->input('user_id') == null) {
            $event->user_id = Auth::id();
        } else {
            $event->user_id = $request->input('user_id');
        }

        // No price for event means free, turn mollie always off!
        if ($event->price == null or $event->price == 0) {
            $event->price = 0;
            $event->mollie_payments = false;
        }

        try {
            // Save the event object
            $event->save();
            if ($event->google_calendar == 1) {
                GoogleCalendarController::createCalendarEvent($event);
            }

            return redirect()->route('management.events.index')
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
        $users = User::all();
        $organizations = Organization::all();
        $locations = Location::all();

        return view('backend.management.events.edit', compact('event', 'locations', 'users', 'organizations'));
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
        if ($event->price == null or $event->price == 0) {
            $event->price = 0;
            $mollie_payments = false;
        }

        // Only update the input booleans
        $event->update(['online' => $online, 'registration' => $registration, 'waitlist' => $waitlist, 'mollie_payments' => $mollie_payments, 'google_calendar' => $google_calendar]);

        try {
            // Update the rest of the event object if needed
            $event->update($request->except(['online', 'registration', 'waitlist', 'mollie_payments', 'google_calendar', 'image']));
            if ($google_calendar == 1 and $event->google_calendar_id == null) {
                // Create new Google Event
                GoogleCalendarController::createCalendarEvent($event);
            } elseif ($google_calendar == 0 and $event->google_calendar_id != null) {
                // Delete Google Event
                GoogleCalendarController::deleteCalendarEvent($event);
            } else {
                // Update Google Event
                GoogleCalendarController::changeCalendarEvent($event);
            }
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('management.events.index')
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

        return redirect()->route('management.events.index')
            ->with('success', 'Event succesvol verwijderd');
    }
}
