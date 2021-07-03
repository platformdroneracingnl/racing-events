<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index() {
        // $user = Auth::user();
        // $user->setSetting('layout_sidebar', true);
        // $user->setSetting('layout_horizontal', false);
        // $user->save();

        // dd(Auth::user()->setting('layout_sidebar'));
        return view('backend.index');
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
    public function changeLayout() {
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
