<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
/*
          $listing = Listing::find(10);

        $user = User::find(2);

        $listing->owner()->associate($user);
        $listing->save();


        dd($user);*/

        return inertia('Listing/Index');
    }

    public function show(){
        return inertia('Index/Show');
    }
}
