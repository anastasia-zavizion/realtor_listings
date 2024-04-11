<?php

namespace App\Http\Controllers;

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
            'deleted'=>$request->boolean('deleted')
        ];


        $listings = Auth::user()->listings()->mostRecent()->filter($filters)->get();

        return inertia('Realtor/Index', [
            'listings' => $listings,
        ]);

    }


    public function destroy(Listing  $listing)
    {
        $listing->deleteOrFail();
        return redirect()->back()->with('success', 'Listing was deleted');
    }
}
