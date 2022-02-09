<?php

namespace App\Http\Controllers;

use Feeds;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feed = Feeds::make(['https://platformdroneracing.nl/feed/'], 8, true); // if RSS Feed has invalid mime types, force to read
        $data = [
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        ];

        return view('backend.news.index')
            ->with($data);
    }
}
