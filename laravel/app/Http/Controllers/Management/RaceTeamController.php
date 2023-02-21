<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreRaceTeamRequest;
use App\Http\Requests\Management\UpdateRaceTeamRequest;
use App\Models\RaceTeam;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class RaceTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('permission:race_team-read|raceteam-create|raceteam-edit|raceteam-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:race_team-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:race_team-update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:race_team-delete', ['only' => ['destroy']]);
        $this->authorizeResource(RaceTeam::class, 'raceteam');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $lang = App::getLocale();
        $race_teams = RaceTeam::orderBy('name', 'ASC')->get();

        return view('backend.management.race_teams.index', compact('race_teams', 'lang'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(Raceteam $raceteam)
    {
        return view('backend.management.race_teams.show', compact('raceteam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.management.race_teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRaceTeamRequest $request)
    {
        $race_team = Raceteam::create($request->validated());

        // Save the uploaded image
        if ($request->has('image')) {
            $image = strtolower($request->validated('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $store_image = Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $store_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/race_teams/'.$filename, $store_image, 'public');
            $race_team->image = $filename;
        }

        try {
            // Save the race team object
            $race_team->save();

            return redirect()->route('management.race_teams.index')
                ->with('success', 'Race Team succesvol aangemaakt');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Raceteam $raceteam)
    {
        return view('backend.management.race_teams.edit', compact('raceteam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRaceTeamRequest $request, Raceteam $raceteam)
    {
        if ($request->has('image')) {
            // Remove old image if exist
            $this->deleteOldImage('race_teams', $request->input('oldImage'));

            // Save the new uploaded image
            $image = strtolower($request->validated('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $store_image = Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $store_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/race_teams/'.$filename, $store_image, 'public');
            $raceteam->update(['image' => $filename]);
        }

        try {
            // Save the rest of the form
            $raceteam->update($request->except(['_token', '_method', 'image']));
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('management.race_teams.index')
                ->with('success', 'Race Team succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Raceteam $raceteam)
    {
        $this->deleteOldImage('race_teams', $raceteam->image);
        $raceteam->delete();

        return redirect()->route('management.race_teams.index')
            ->with('success', 'Race Team succesvol verwijderd');
    }
}
