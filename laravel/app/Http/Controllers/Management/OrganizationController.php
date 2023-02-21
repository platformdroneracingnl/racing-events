<?php

namespace App\Http\Controllers\Management;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreOrganizationRequest;
use App\Http\Requests\Management\UpdateOrganizationRequest;
use App\Models\Organization;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Image;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('permission:organization-read|organization-create|organization-update|organization-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:organization-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:organization-update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:organization-delete', ['only' => ['destroy']]);
        $this->authorizeResource(Organization::class, 'organization');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $lang = App::getLocale();
        $organizations = Organization::orderBy('id', 'ASC')->get();

        return view('backend.management.organizations.index', compact('organizations', 'lang'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization): View
    {
        return view('backend.management.organizations.show', compact('organization'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.management.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request): RedirectResponse
    {
        $organization = Organization::create($request->validated());

        // Save the uploaded image
        if ($request->has('image')) {
            $image = strtolower($request->validated('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $storage_image = Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $storage_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/organizations/'.$filename, $storage_image, 'public');
            $organization->image = $filename;
        }

        try {
            $organization->save();

            return redirect()->route('management.organizations.index')
                ->with('success', 'Organisatie succesvol aangemaakt');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization): View
    {
        return view('backend.management.organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): RedirectResponse
    {
        if ($request->has('image')) {
            // Remove old image if exist
            $this->deleteOldImage('organizations', $request->input('oldImage'));

            // Save the new uploaded image
            $image = strtolower($request->validated('name'));
            $filename = str_replace(' ', '', $image.'-'.time().'.'.'png');
            $storage_image = Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $storage_image->stream();

            // Save image file in storage folder
            Storage::disk('local')->put('public/images/organizations/'.$filename, $storage_image, 'public');
            $organization->update(['image' => $filename]);
        }

        try {
            // Save the rest of the form
            $organization->update($request->except(['_token', '_method', 'image']));
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('management.organizations.index')
                ->with('success', 'Organisatie succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization): RedirectResponse
    {
        // Remove old image if exist
        $this->deleteOldImage('organizations', $organization->image);
        $organization->delete();

        return redirect()->route('management.organizations.index')
            ->with('success', 'Organisatie succesvol verwijderd');
    }
}
