<?php

namespace App\Http\Controllers\Organizator;

use App;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Waiver;
use Auth;
use Illuminate\Http\Request;

class WaiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:event-list|event-create|event-edit|event-delete|event-registration|event-checkin', ['only' => ['index', 'exportPDF']]);
    }

    /**
     * Index list
     */
    public function index()
    {
        $lang = App::getLocale();

        // Find all the waivers from all the events of a organizator
        $events = User::with('events')->find(Auth::user()->id)->events->pluck('id');
        $result = Waiver::whereIn('event_id', $events)->get();

        return view('backend.organizator.waivers.index', compact('result', 'lang'));
    }
}
