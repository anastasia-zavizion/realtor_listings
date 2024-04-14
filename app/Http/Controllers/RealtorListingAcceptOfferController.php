<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer){

        $this->authorize('update',$offer->listing);

        $offer->update([
            'accepted_at'=>now(),
            'rejected_at'=>null,
        ]);

        $offer->listing->sold_at = now();
        $offer->listing->save();


        $offer->listing->offers()->except($offer)->update([
            'accepted_at'=>null,
            'rejected_at'=>now(),
        ]);

        return redirect()->back()->with('success', "Offer #{$offer->id} accepted");
    }
}
