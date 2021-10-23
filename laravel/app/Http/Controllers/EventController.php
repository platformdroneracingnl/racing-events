<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Event;
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

    public function show() {
        
    }
}
