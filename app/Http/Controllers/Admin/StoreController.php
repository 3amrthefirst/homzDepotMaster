<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
class StoreController extends Controller
{

    public function entryPoint(){
        return view('admin.store.index');
    }

    //here functions for products have quantity

    public function getProducts(Request $request){
        $products = Product::where(function ($q) use ($request) {
            if ($request->name) {
                $q->where(function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%');
                });
            }

        })
        ->whereNotNull('original_quantity')
        ->where('status','accepted')
        ->paginate();

        return view('admin.store.products.storeProducts',compact('products'));
    }

    public function showProductOnStore($id){
        $data = Product::findOrFail($id);
        return view('admin.store.products.showProduct',compact('data'));
    }


}
