<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request): Renderable
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }

        return abort(404);
    }

    public function root(): View
    {
        return view('frontend.home');
    }
}
