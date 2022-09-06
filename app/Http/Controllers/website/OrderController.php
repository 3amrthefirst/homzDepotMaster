<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function orderDetails($id){
        $order = Order::findOrFail($id);
        $products = $order->products()->get();
        return view('website.order-details',compact('order','products'));

    }
    
     public function cancelOrder($id){
        $order = Order::findOrFail($id);
        $order->status = 'canceled';
        $order->save();
        return back()->withInput()->withErrors(['success' => 'تم تقديم إلغاء الطلب بنجاح']);
    }
}
