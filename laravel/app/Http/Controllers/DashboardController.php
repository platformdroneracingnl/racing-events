<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

class DashboardController extends Controller
{
    public function index(): View
    {
        // $user = Auth::user();
        // $user->setSetting('layout_sidebar', true);
        // $user->setSetting('layout_horizontal', false);
        // $user->save();

        // dd(Auth::user()->setting('layout_sidebar'));

        $agent = new Agent();

        // Geef waardes mee voor wedstrijd overzicht
        $events = Event::orderBy('date', 'asc')
            ->take(5)
            ->get()
            ->where('online', 1)
            ->where('date', '>=', Carbon::today());
        $registrations = Registration::where('user_id', Auth::id())->take(8)->get();

        return view('backend.index', compact('events', 'agent', 'registrations'));
    }

    /*Language Translation*/
    // public function lang($locale)
    // {
    //     if ($locale) {
    //         App::setLocale($locale);
    //         Session::put('lang', $locale);
    //         Session::save();
    //         return redirect()->back()->with('locale', $locale);
    //     } else {
    //         return redirect()->back();
    //     }
    // }

    /**
     * Change the layout
     */
    public function changeLayout(): RedirectResponse
    {
        $user = Auth::user();
        if ($user->setting('layout_sidebar')) {
            $user->setSetting('layout_sidebar', false);
        } else {
            $user->setSetting('layout_sidebar', true);
        }
        $user->save();

        return redirect()->back();
    }
}
