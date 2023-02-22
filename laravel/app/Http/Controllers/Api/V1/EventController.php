<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\Event as EventResource;
use App\Http\Resources\V1\EventCollection;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $events = Event::all();

        return $this->sendResponse(new EventCollection($events), 'All events retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): JsonResponse
    {
        if (is_null($event)) {
            return $this->sendError('Event not found.');
        }

        return $this->sendResponse(new EventResource($event), 'Event retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->sendError('Not implemented.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->sendError('Not implemented.');
    }
}
