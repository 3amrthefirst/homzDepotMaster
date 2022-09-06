<?php

namespace App\Http\Livewire;

use App\Models\DiscountCode;
use App\Models\Goverment;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Illuminate\View\View;

use Auth;

class CartList extends Component
{

  public $cart;
  public $code;
  public $total_after_discount;
  public $shipping;
  public $governId;

        public function mount(): void
        {
            $this->cart = Cart::content();
        }
      public function deleteRow($rowId)
      {
        Cart::remove($rowId);
        $this->cart = Cart::content();
        $this->emit('productRemoved');
        session()->flash('success', ' تم حذف المنتج بنجاح');




    }
    
    public function emptyCart(){

        Cart::destroy();
        $this->cart = Cart::content();
        $this->emit('productRemoved');
        session()->flash('success', __('تم   افراغ العربه بنجاح'));
    }

    public function incQuantity($rowId)
    {

        $cart = Cart::get($rowId);
        $product=Product::findorfail($cart->id);
        $qty= $cart->qty+1;
        if($product->original_quantity ){
            if($qty <= $product->availableQuantity){
            Cart::update($rowId, $qty);
            $this->emit('productInc');
            }
            else{
                session()->flash('message', 'لا يمكن زياده الكميه عن متوفر في المخزن');

            }
        }
         else{

                Cart::update($rowId, $qty);
                $this->emit('productInc');
           }



    }

    public function decQuantity($rowId)
    {
        $product = Cart::get($rowId);
        if($product->qty-1>0){
        $qty= $product->qty-1;
        Cart::update($rowId, $qty);
        $this->emit('productDec');
        }
        else{
            session()->flash('message', 'لا يمكن تقليل الكميه عن منتج واحد');
        }


    }

    public function applyCode(){
    if($this->code){
     $discountCode=DiscountCode::where('code',$this->code)->where('is_active',1)->first();
     if(!$discountCode){ session()->flash('notValidCode', 'كود الخصم غير صحيح');}
     else{
        $total_price=$discountCode->total_price;
        $status=$discountCode->status;
         if($discountCode->maxUser>0){
            if(auth()->user())
            { 
                if(count($discountCode->customers))
                {
                    foreach($discountCode->customers as $customer)
                    {
                    
                        if($customer->customer_id == auth()->user()->id){
            
                            session()->flash('notValidCode',  'لقد تم استخدام كود الخصم من قبل');
                            break;
                        }
                        
                        if($total_price){
                            if( Cart::subtotal()>=$total_price){
                            if($status=="value") {
                                $this->total_after_discount=floor(Cart::subtotal()-$discountCode->value);
                                }
                                if($status=="percent") {
                                $discount=floor(Cart::subtotal() * ($discountCode->value/100));
                                if($discount > $discountCode->max_value)
                                {
                                    $this->total_after_discount=floor(Cart::subtotal()-$discountCode->max_value);

                                }else{
                                $this->total_after_discount=floor(Cart::subtotal()-$discount);
                                }            
                            }
                            session()->flash('validCode', ' تم تفعيل كود الخصم  ');
            
                            }
                            else{ session()->flash('notValidCode',  ' يجب ان يكون سعر الطلب مساوي او اكبر من' . $total_price .'جنيه');}
                        }
                
                     }

                }else{
                        if($total_price){
                            if( Cart::subtotal()>=$total_price){
                               if($status=="value") {
                                  $this->total_after_discount=floor(Cart::subtotal()-$discountCode->value);
                                }
                                if($status=="percent") {
                                 $discount=Cart::subtotal() * ($discountCode->value/100);
                                if($discount > $discountCode->max_value)
                                {
                                    $this->total_after_discount=floor(Cart::subtotal()-$discountCode->max_value);

                                }else{
                                $this->total_after_discount= floor(Cart::subtotal()-$discount);
                                }                 
                              }
                             session()->flash('validCode', ' تم تفعيل كود الخصم  ');
             
                            }
                            else{ session()->flash('notValidCode',  ' يجب ان يكون سعر الطلب مساوي او اكبر من' . $total_price .'جنيه');}
                         }
    
                }
              
                
                

    
            }
            else{
                if($total_price){
                    if( Cart::subtotal()>=$total_price){
                       if($status=="value") {
                          $this->total_after_discount=floor(Cart::subtotal()-$discountCode->value);
                        }
                        if($status=="percent") {
                         $discount=Cart::subtotal() * ($discountCode->value/100);
                         if($discount > $discountCode->max_value)
                                {
                                    $this->total_after_discount=floor(Cart::subtotal()-$discountCode->max_value);

                                }else{
                                $this->total_after_discount=floor( Cart::subtotal()-$discount);
                                }         
                      }
                     session()->flash('validCode', ' تم تفعيل كود الخصم  ');
     
                    }
                    else{ session()->flash('notValidCode',  ' يجب ان يكون سعر الطلب مساوي او اكبر من' . $total_price .'جنيه');}
                 }

            }
                

            
            
            
         }
         
         else{ session()->flash('notValidCode', 'لقد تم استهلاك كود الخصم');}
        }
        



     }
    
     else{
        session()->flash('notValidCode','برجاء ادخال كود الخصم');

    }

    }
    public function resetCode(){
        dd('hey');
    }
    public function shipping(){
        $govern= Goverment::findorfail($this->governId);
        $this->shipping=$govern->price;
    }

      public function render()
      {
        if (empty($this->code))
        {
            $this->total_after_discount ='';
         }

        $this->cartItems=Cart::content()->sortBy('id');

       return view('livewire.cart-list');
      }
}
