<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);

        return inertia('Listing/Index', [
            'filters'=>$filters,
            'listings'=>Listing::mostRecent()->filter($filters)->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
       // $this->authorize('create',Listing::class);

        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ListingRequest $request)
    {
        $request->user()->listings()->create($request->validated());
        return redirect()->route('listing.index')->with('success','Listing was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function show(Listing $listing)
    {
       // $this->authorize('view',$listing);

        return inertia('Listing/Show', [
            'listing'=>$listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(Listing $listing)
    {
        return inertia('Listing/Edit', [
            'listing'=>$listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        $listing->update($request->validated());
        return redirect()->route('listing.index')->with('success','Listing was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Listing  $listing)
    {
        $listing->delete();
        return redirect()->back()->with('success', 'Listing was deleted');
    }
}
