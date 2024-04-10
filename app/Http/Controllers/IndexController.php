<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){

        $listings = Auth::user()->listings()->where('price','>=', 4000)->get();

/*        dd(User::with('listings')->get());
        dd(Auth::user()->listings);
        dd($listings);*/

/*
          $listing = Listing::find(10);

        $user = User::find(2);

        $listing->owner()->associate($user);
        $listing->save();


        dd($user);*/

        dd();

        return inertia('Listing/Index');
    }

    public function show(){
        return inertia('Index/Show');
    }
}
