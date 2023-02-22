<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\RegistrationCollection;
use App\Models\Registration;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistrationController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $registrations = Registration::where('user_id', '=', Auth::id())->get();

        return $this->sendResponse(new RegistrationCollection($registrations), 'All your registrations retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        return $this->sendError('Not implemented.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return $this->sendError('Not implemented.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return $this->sendError('Not implemented.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): JsonResponse
    {
        return $this->sendError('Not implemented.');
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
