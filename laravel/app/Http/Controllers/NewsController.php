<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Feeds;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $feed = Feeds::make(['https://platformdroneracing.nl/feed/'], 8, true); // if RSS Feed has invalid mime types, force to read
        $data = [
            'title' => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items' => $feed->get_items(),
        ];

        return view('backend.news.index')
            ->with($data);
    }
}
