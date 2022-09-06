<?php

namespace App\Traits;

use App\Models\CustomerDiscountcode;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DiscountCode;
use App\Models\Goverment;
use App\Models\Order;
use DB;
use Session;


Trait OrderTrait
{
      function saveOrder(){
                    $discount_code_id=null;
                    $customer= Customer::findOrFail(auth()->id());
                    $government= Goverment::findorfail(Session::get('government_id'));
                    $cartitems=Cart::content();
                        if(Session::get('code') && Session::get('total_after_discount'))
                        {
                            $code=DiscountCode::where('code',Session::get('code'))->first();
                            $discount_code_id=$code->id;

                        }
                        $row = Order::orderBy('code', 'desc')->first();
                        $code = 0;
                        if ($row != null) {
                            $last_id = $row->code;
                            $id = explode('-', $last_id);
                            $id = ++$id[0];
                            $code = $id;
                        } else {
                            $code ='HOM160001';
                        }
                        Session::put([
                            'customer_id'=> $customer->id,
                            'code'=>$code,
                            'status'=>'pending',
                            'totalPrice'=>Cart::subtotal(),
                            'discount_code_id'=>$discount_code_id,
                            'shipping'=>$government->price,
                        ]);
                        DB::beginTransaction();

                        try {

                            $order=Order::create(session()->all());
                             /// update use of discount code
                             if($discount_code_id ){
                                $discountcode=DiscountCode::findorfail($discount_code_id);
                                $maxuser=$discountcode->maxUser;
                                $discountcode->update(['maxUser'=> $maxuser-1]);
                                CustomerDiscountcode::create(['customer_id'=>auth()->user()->id,
                                'duscountCode_id'=>$discount_code_id]);
                            }

                            foreach ($cartitems as $cartitem) {
                                $orderProduct=$order->products()->create([
                                'product_id'=>$cartitem->id,
                                'quantity'=>$cartitem->qty,
                                'price'=>$cartitem->price,
                            ]);
                           
                            //calc profit of suppliier
                            $product=Product::findorfail($orderProduct->product_id);
                            $categoryPrice=$product->subCategory->price;
                            $supplierProfit= $orderProduct->price-$categoryPrice;
                            $supplier=$product->supplier;
                            // $websitePercent=$supplierProfit * ($supplier->adminProfit/100);
                            $profit= $supplierProfit * $orderProduct->quantity;
                            $supplier->allProfit=$supplier->allProfit+ $profit ;
                            $supplier->availableProfit=$supplier->availableProfit + $profit;
                            $supplier->save();

                             //check if product has quantity or not , and decrease quantity if has .
                             $product->update([
                                 'saledQuantity'=>$product->saledQuantity + $cartitem->qty,
                             ]);
                             if($product->availableQuantity > 0 ){
                                $product->update([
                                   'availableQuantity'=> $product->availableQuantity - $cartitem->qty,
                                ]);
                            }
                            }


                            Cart::destroy();
                            DB::commit();
                            // session()->flash('success', __('تم  اكمال الطلب بنجاح'));
                            // return redirect()->back()->with(['order'=>$order]);
                            return $order;
                            } catch (\Exception $e) {
                            DB::rollback();
                            session()->flash('message', 'حدث خطأ');
                            return redirect()->back();
                        }


        
    }
}
