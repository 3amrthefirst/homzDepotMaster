<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Supplier;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;

class SupplierProducts extends Component
{

    public $supplierId;
    public function mount(){
        $this->fill(request()->only('supplierId'));
    }
    public function render()
    {
        $products = Product::where('supplier_id',$this->supplierId)
        ->where('status','accepted')
        ->where('is_active',1)
        ->latest()
        ->paginate(16);
        
        $amount = Product::where('supplier_id',$this->supplierId)
        ->where('status','accepted')
        ->where('is_active',1)
        ->get();

        $supplier = Supplier::findOrFail($this->supplierId);
        return view('livewire.supplier-products',compact('products','supplier','amount'));

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
