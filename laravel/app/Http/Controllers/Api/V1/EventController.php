<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Event;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Resources\V1\Event as EventResource;
use App\Http\Resources\V1\EventCollection;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return $this->sendResponse(new EventCollection($events), 'All events retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if (is_null($event)) {
            return $this->sendError('Product not found.');
        }
        return $this->sendResponse(new EventResource($event), 'Event retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
