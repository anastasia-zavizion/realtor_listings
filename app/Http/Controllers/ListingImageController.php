<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingImageRequest;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia('Realtor/ListingImage/Create', ['listing' => $listing]);
    }

    public function store(Listing $listing, ListingImageRequest $request)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $folderName = 'images';
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image->scale(width: 200);
                if (!Storage::disk('public')->exists($folderName)) {
                    Storage::disk('public')->makeDirectory($folderName);
                }
                $path = "$folderName/$fileName";
                $image->toJpeg()->save(Storage::disk('public')->path($path));
                $listing->images()->save(new ListingImage([
                    'file_name' => $path
                ]));
            }
        }
        return redirect()->back()->with('success', 'Images uploaded');
    }

    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->file_name);
        $image->delete();
        return redirect()->back()->with('success', 'Image was deleted');
    }
}
