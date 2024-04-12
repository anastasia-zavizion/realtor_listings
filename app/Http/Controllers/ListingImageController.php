<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\ListingImage;

class ListingImageController extends Controller
{
    public function create(Listing $listing){
        $listing->load(['images']);
        return inertia('Realtor/ListingImage/Create', ['listing'=>$listing]);
    }

    public function store(Listing $listing,Request $request){

        if($request->hasFile('images')){
            foreach ($request->file('images') as $file){
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'file_name'=>$path
                ]));

            }
        }

        return redirect()->back()->with('success', 'Images uploaded');

    }

    public function destroy(){

    }
}
