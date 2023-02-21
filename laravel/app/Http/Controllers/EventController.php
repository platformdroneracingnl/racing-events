<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App;
use App\Models\Event;
use Auth;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        // If event is allowed to be visible and until the day of the match
        $lang = App::getLocale();
        $events = Event::orderBy('date', 'asc')
            ->get()
            ->where('online', 1)
            ->where('date', '>=', Carbon::today());
        if (Auth::check()) {
            return view('backend.events.index', compact('events', 'lang'));
        } else {
            return view('frontend.events', compact('events'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event): View
    {
        $lang = App::getLocale();
        $agent = new Agent();

        // Determine who the organisator is (person or organization)
        if (empty($event->organization_id)) {
            $finalOrganizator = $event->user->name;
        } else {
            $finalOrganizator = $event->organization->name;
        }

        return view('backend.events.show', compact('event', 'lang', 'agent', 'finalOrganizator'));
    }
}
