<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status','accepted')
        ->where('is_active',1)
        ->latest()->paginate(4);
        return view('website.index',compact('products'));
    }
    public function terms(){
        return view('website.terms-conditions');
    }
    public function policy(){
        return view('website.return-policy');
    }

    public function aboutUs(){
        return view('website.about-us');
    }
    public function privacy(){
        return view('website.privacy-policy');
    }



}
