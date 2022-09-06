<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;


class ProductController extends Controller
{
    public function allProducts(){ 
        return view('website.products');
    }

    public function productDetail($id){
        $product = Product::findOrFail($id);
        $category = $product->subcategory()->first();
        return view('website.product-details',compact('product'));
    }

  public function subCategoryProducts(){
        return view('website.category');

    }
    public function search(){
        return view('website.search');
    }
      public function supplierProducts($supplierId){
        return view('website.supplier',compact('supplierId'));
    }
}
