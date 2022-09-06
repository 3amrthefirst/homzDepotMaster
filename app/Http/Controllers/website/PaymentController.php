<?php

namespace App\Http\Controllers\website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Goverment;
use App\Traits\OrderTrait;
use Session;
use App\Models\Paymob;




class PaymentController extends Controller
{
    use OrderTrait;
    protected $total;
    protected $shipping;

    
    public function credit(Request $request) {
          
         $government= Goverment::findorfail(Session::get('government_id'));
        $this->shipping=$government->price;
         if(Session::get('code') && Session::get('total_after_discount'))
        {
            $this->total=$request->total_after_discount+$this->shipping;

        }
        else{
            $this->total=Cart::subtotal()+$this->shipping;
        }
        $token = $this->getToken();
        $order = $this->createOrder($token);
        $paymentToken = $this->getPaymentToken($order, $token);
           

        return \Redirect::away('https://accept.paymob.com/api/acceptance/iframes/442015'.'?payment_token='.$paymentToken);
        
    }
    public function getToken(){
        $response = Http::post('https://accept.paymob.com/api/auth/tokens',[
            'api_key' => "ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0luQnliMlpwYkdWZmNHc2lPakkyT0RBMU9Dd2lZMnhoYzNNaU9pSk5aWEpqYUdGdWRDSjkubWhOU0lXamlGNmp3LU96Z0pTem5xd3JNWGhMdkQtQlhnS2JPZDZhRzdNQkRQUTBmUVdrQ1ZCWjAzTzVMVWdSMHltOVc2MFg3ZjBuVF9CSUhvczQ4Y0E="
        ]);
        return $response->object()->token;
    }

    public function createOrder($token) {
        
        //put items here "amr"
          $cartitems=cart::content();
           $items=[];
            foreach($cartitems as $cartitem){
              array_push($items ,
            [ "name"=> $cartitem->name,
                "amount_cents"=> $cartitem->price,
                "description"=> "test",
                "quantity"=> $cartitem->qty
            ]);
            }
         
    
            $finalPrice = $this->total * 100 ;
        $data = [
            "auth_token" =>   $token,
            "delivery_needed" =>"false",
            "amount_cents"=> $finalPrice, //put final price here "amr"
            "currency"=> "EGP",
            //"items"=> $items,

        ];
               

        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', $data);
        return $response->object();
    }

    public function getPaymentToken($order, $token)
    {
        $billingData = [
            "apartment" => "803",
            "email" => "claudette09@exa.com",
            "floor" => "42",
            "first_name" => "Clifford",
            "street" => "Ethan Land",
            "building" => "8028",
            "phone_number" => "+86(8)9135210487",
            "shipping_method" => "PKG",
            "postal_code" => "01898",
            "city" => "Jaskolskiburgh",
            "country" => "CR",
            "last_name" => "Nicolas",
            "state" => "Utah"
        ];
          $finalPrice = $this->total * 100 ;
        $data = [
            "auth_token" => $token,
            "amount_cents" => $finalPrice,
            "expiration" => 3600,
            "order_id" => $order->id,
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => 2535064
        ];
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
        return $response->object()->token;
    }
    public function callback(Request $request)
    {

        $data = $request->all();
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if(in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = '23E84D8432EECCB7ECCC6F2B8A8768EC';
        $hased = hash_hmac('sha512', $connectedString, $secret);

        if ( $hased == $hmac && $data['success'] =="true") {
            
                 $order= $this->saveOrder();
                 Paymob::create([
                    "status" => $data['pending'],
                    "order" =>$data['order'],
                    "amount_cent" => $data['amount_cents'],
                    "success" => $data['success'],
                    "error_occured" => $data['error_occured'],
                    "is_refunded" => $data['is_refunded'],
                    "order_id" =>$order->id,
                    "customer_id" =>auth()->id(),
                    ]);
                 session()->flash('success', __('تم  اكمال الطلب بنجاح'));
                 return redirect('cart');
                
        }
        else{
            session()->flash('message','حدث مشكله اثناء الدفع');
           return redirect('cart');
        }

    }
}
