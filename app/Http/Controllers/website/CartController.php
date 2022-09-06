<?php

namespace App\Http\Controllers\Website;

use App\Models\CustomerDiscountcode;
use App\Http\Controllers\Controller;
use App\Traits\OrderTrait;


use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DiscountCode;
use App\Models\Goverment;
use App\Models\Order;
use DB;
use Session;



class CartController extends Controller
{
    use OrderTrait;
    public function index(){

        return view('website.cart');
    }

    public function deleteRow($rowId)
    {
      Cart::remove($rowId);
      session()->flash('success', ' تم حذف المنتج بنجاح');
      return back();

    }

    public function add($id){
        $product=Product::findorfail($id);
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
            session()->flash('success','تم اضافه المنتج للعربه');
            return back()->withInput()->withErrors(['success' => 'تم اضافه المنتج للعربه ']);
        }

        public function checkout(Request $request){

            $rules = [
                'code' => 'nullable|exists:discountCodes,code',
                'total_after_discount' => 'numeric|nullable',
                'name'=>'required',
                'phone'=>'required|regex:/(01)[0-9]{9}/|size:11',
                'phone2' => 'nullable|regex:/(01)[0-9]{9}/|size:11',
                'address'=>'required',

            ];
            $message=[

            ];
            $data = validator()->make($request->all(), $rules, $message);

            if ($data->fails()) {
                session()->flash('message','برجاء اكمال البيانات بشكل صحيح');

                return redirect()->back();


            }
            else{
                if(!count(cart::content()))
                {
                    session()->flash('message','لا يمكن اتمام الشراء العربه فارغه');
                    return redirect()->back();
                }
                elseif(!$request->government_id)
                {
                    session()->flash('message','يجب تحديد المحافظه قبل أتمام الشراء');
                    return redirect()->back();


                }else{
                    Session::put($request->all());

                    if ($request->input('action')== "visa") {
                        session::put(['type'=>'visa']);
                            return redirect(route('cart.credit'));
                    }
                    elseif($request->input('action')== "cash"){
                        session::put(['type'=>'cash']);
                        $this->saveOrder();
                        session()->flash('success', __('تم  اكمال الطلب بنجاح'));
                        return redirect('cart');

                      
    
                 
                }
                 
                
                     }
            }
        }

        


}
