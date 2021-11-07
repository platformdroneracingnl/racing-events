<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\Location;
Use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use App;

class EventController extends Controller
{
    public function index() {
        // If event is allowed to be visible and until the day of the match
        $lang = App::getLocale();
        $events = Event::orderBy('date', 'asc')
            ->get()
            ->where('online', 1)
            ->where('date', '>=', Carbon::today());

        return view('backend.events.index', compact('events','lang'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event) {
        $lang = App::getLocale();
        $agent = new Agent();
        $person = User::where('id', $event->user_id)->get();

        // Determine who the organisator is (person or organization)
        if(empty($event->organization)) {
            $finalOrganizator = $person;
        } else {
            $finalOrganizator = $event->organization;
        }

        return view('backend.events.show',compact('event','lang','agent','finalOrganizator'));
    }
}
