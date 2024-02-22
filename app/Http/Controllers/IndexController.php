<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return inertia('Listing/Index');
    }

    public function show(){
        return inertia('Index/Show');
    }
}
