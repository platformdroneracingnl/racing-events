<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\Location as LocationResource;
use App\Http\Resources\V1\LocationCollection;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $locations = Location::all();

        return $this->sendResponse(new LocationCollection($locations), 'All locations retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location): JsonResponse
    {
        if (is_null($location)) {
            return $this->sendError('Location not found.');
        }

        return $this->sendResponse(new LocationResource($location), 'Location retrieved successfully.');
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
