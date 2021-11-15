<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Spatie\GoogleCalendar\Event;
use Illuminate\Http\Request;
use DB;

class GoogleCalendarController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('permission:event-create', ['only' => ['createCalendarEvent']]);
        $this->middleware('permission:event-edit', ['only' => ['changeCalendarEvent']]);
        $this->middleware('permission:event-delete', ['only' => ['deleteCalendarEvent']]);
    }

    /**
     * Make new Google Event
     */
    public static function createCalendarEvent($competition) {
        $event = new Event();
        $event->name        = $competition->name;
        $event->startDate   = $competition->date;
        $event->endDate     = $competition->date;
        $event->description = $competition->description;
        $eventId = $event->save();
        // Add ID to table
        DB::table('events')->where('id', $competition->id)->update(['google_calendar_id' => $eventId->id]);
        return;
    }

    /**
     * Change existed Google Event
     */
    public static function changeCalendarEvent($competition) {
        $event = Event::find($competition->google_calendar_id);
        $event->name        = $competition->name;
        $event->startDate   = $competition->date;
        $event->endDate     = $competition->date;
        $event->description = $competition->description;
        $event->save();
        return;
    }

    /**
     * Delete a Google Event
     */
    public static function deleteCalendarEvent($competition) {
        $event = Event::find($competition->google_calendar_id);
        $event->delete();
        // Delete ID from table
        DB::table('events')->where('id', $competition->id)->update(['google_calendar_id' => null]);
        return;
    }
}
