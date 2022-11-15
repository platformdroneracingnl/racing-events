<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Location;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lang = App::getLocale();
        $locations = Location::orderBy('name', 'ASC')->get();

        return view('backend.management.locations.index', compact('locations', 'lang'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('backend.management.locations.show', compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();

        return view('backend.management.locations.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valide input
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,svg',
        ]);

        $location = new Location();

        // Basic information
        $location->name = $request->input('name');
        $location->street = $request->input('street');
        $location->house_number = $request->input('house_number');
        $location->zip_code = $request->input('zip_code');
        $location->city = $request->input('city');
        $location->province = $request->input('province');
        $location->country_id = $request->input('country_id');
        $location->category = $request->input('category');
        $location->description = $request->input('description');

        // Coordinates
        $location->latitude = $request->input('latitude');
        $location->longitude = $request->input('longitude');

        // Save the uploaded image
        if ($request->has('image')) {
            $image = strtolower($request->input('name'));
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
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        // Valide input
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,svg',
        ]);

        if ($request->has('image')) {
            // Remove old image if exist
            $this->deleteOldImage('locations', $request->input('oldImage'));

            // Save the new uploaded image
            $image = strtolower($request->input('name'));
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
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $this->deleteOldImage('locations', $location->image);
        $location->delete();

        return redirect()->route('management.locations.index')
            ->with('success', 'Locatie succesvol verwijderd');
    }
}
