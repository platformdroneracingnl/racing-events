<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreLocationRequest;
use App\Http\Requests\Management\UpdateLocationRequest;
use App\Models\Country;
use App\Models\Location;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Image;
use JavaScript;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('permission:location-read|location-create|location-update|location-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:location-update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:location-delete', ['only' => ['destroy']]);
        $this->authorizeResource(Location::class, 'location');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lang = App::getLocale();
        $locations = Location::orderBy('name', 'ASC')->get();

        return view('backend.management.locations.index', compact('locations', 'lang'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location): View
    {
        return view('backend.management.locations.show', compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::get();

        return view('backend.management.locations.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request): RedirectResponse
    {
        $location = Location::create($request->validated());

        // Save the uploaded image
        if ($request->has('image')) {
            $image = strtolower($request->validated('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $storage_image = Image::make($request->image)->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
            });
            $storage_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/locations/'.$filename, $storage_image, 'public');
            $location->image = $filename;
        }

        try {
            $location->save();

            return redirect()->route('management.locations.index')
                ->with('success', 'Locatie succesvol aangemaakt');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location): View
    {
        $countries = Country::get();

        JavaScript::put([
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
        ]);

        return view('backend.management.locations.edit', compact('location'))
            ->with('countries', $countries);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location): RedirectResponse
    {
        if ($request->has('image')) {
            // Remove old image if exist
            $this->deleteOldImage('locations', $request->input('oldImage'));

            // Save the new uploaded image
            $image = strtolower($request->validated('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $storage_image = Image::make($request->image)->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
            });
            $storage_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/locations/'.$filename, $storage_image, 'public');
            $location->update(['image' => $filename]);
        }

        try {
            $location->update($request->except(['_token', '_method', 'leaflet-base-layers_52', 'image']));
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('management.locations.index')
                ->with('success', 'Locatie succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location): RedirectResponse
    {
        $this->deleteOldImage('locations', $location->image);
        $location->delete();

        return redirect()->route('management.locations.index')
            ->with('success', 'Locatie succesvol verwijderd');
    }
}
