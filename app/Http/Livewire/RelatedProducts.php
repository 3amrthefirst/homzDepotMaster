<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class RelatedProducts extends Component
{
    public $productId;

    public function render()
    {
        $product = Product::findOrFail($this->productId);
        $category = $product->subcategory()->first();
        $relatedProducts = Product::where('subCategory_id',$category->id)
        ->where('id','!=',$product->id)
        ->where('status','accepted')
        ->where('is_active',1)
        ->paginate(4);
        return view('livewire.related-products',compact('relatedProducts'));
    }
    public function addToCart($productId){
        $product=Product::findorfail($productId);
        $attachments = $product->attachmentRelation()->whereNull('usage')->first();
        //declare price
        if($product->discountPercentStatus == 1){
            $price=$product->prodcuts_price_after_discount_percents;
        }
        elseif($product->discountValueStatus == 1){
            $price=$product->ProductPriceAfterDiscountValue;
        }
        else{
            $price=$product->ProductPrice;
        }
        //create cart
        $cart = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty'=>1,
            'price' => $price,
            'options' => [
                'attachments' => $attachments->path ?? null,
                'colorName'=>$product->colorName,
                'code'=>$product->code,

            ]]);
            $this->emit('productAdded');

            session()->flash('success','تم اضافه المنتج للعربه');

    }
}
