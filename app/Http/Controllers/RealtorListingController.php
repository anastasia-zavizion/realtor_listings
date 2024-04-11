<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RealtorListingController extends Controller
{

    public function __construct()
    {
       $this->authorizeResource(Listing::class, 'listing');
    }


    public function index(Request $request){

        $filters = [
            'deleted'=>$request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];


        $listings = Auth::user()->listings()->filter($filters)->paginate(5)->withQueryString();

        return inertia('Realtor/Index', [
            'listings' => $listings,
            'filters'=>$filters
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Realtor/Create');
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
        return redirect()->route('realtor.listing.index')->with('success','Listing was created');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(Listing $listing)
    {
        return inertia('Realtor/Edit', [
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
        return redirect()->route('realtor.listing.index')->with('success','Listing was updated');
    }


    public function destroy(Listing  $listing)
    {
        $listing->deleteOrFail();
        return redirect()->back()->with('success', 'Listing was deleted');
    }

    public function restore(Listing  $listing)
    {
        $listing->restore();
        return redirect()->back()->with('success', 'Listing was restored');
    }
}
