<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingOfferRequest;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, ListingOfferRequest $request)
    {
        $this->authorize('view',$listing);
        $listing->offers()->save(Offer::make($request->validated())->bidder()->associate(Auth::user()));
        return redirect()->back()->with('success','Offer was made');
    }
}
