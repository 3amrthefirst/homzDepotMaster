<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Supplier;
use App\Models\RefundProduct;


class OrderController extends Controller
{

  public function index(){
    $supplier=Supplier::Findorfail(auth()->user()->id);
    $products=$supplier->products->where('saledQuantity' , '!=',0);

    
    return view('supplier.orders.index',compact('products'));
  }
  public function receivedOrders(){
    $supplier=Supplier::Findorfail(auth()->user()->id);
    $products=$supplier->products->where('saledQuantity' , '!=',0);
  return view('supplier.orders.receivedOrders',compact('products'));
  }
  public function refundOrders(){
    $supplier=Supplier::Findorfail(auth()->user()->id);
    $refunds=RefundProduct::where('supplier_id',$supplier->id)->latest()->paginate();
    
  return view('supplier.orders.refundOrders',compact('refunds'));
  }





}
