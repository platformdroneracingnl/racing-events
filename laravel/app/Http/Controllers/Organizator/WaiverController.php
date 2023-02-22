<?php

namespace App\Http\Controllers\Organizator;

use App;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Waiver;
use Auth;
use Illuminate\View\View;

class WaiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:event-read|event-create|event-update|event-delete|event-registration|event-checkin', ['only' => ['index', 'exportPDF']]);
    }

    /**
     * Index list
     */
    public function index(): View
    {
        $lang = App::getLocale();

        // Find all the waivers from all the events of a organizator
        $events = User::with('events')->find(Auth::id())->events->pluck('id');
        $waivers = Waiver::whereIn('event_id', $events)->get();

        return view('backend.organizator.waivers.index', compact('waivers', 'lang'));
    }
}
