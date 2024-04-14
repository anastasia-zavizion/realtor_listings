<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingOfferRequest;
use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Support\Facades\Auth;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, ListingOfferRequest $request)
    {
        $this->authorize('view',$listing);
        $offer = $listing->offers()->save(Offer::make($request->validated())->bidder()->associate(Auth::user()));

        $listing->owner->notify(new OfferMade($offer));

        return redirect()->back()->with('success','Offer was made');
    }
}
