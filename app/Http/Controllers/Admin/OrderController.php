<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Log;
use App\Models\Product;
use App\Models\Paymob;


class OrderController extends Controller
{

  //pending orders functions start

  public function pendingOrders (Request $request){
    $records = Order::where('status', 'pending')
    ->where(function ($q) use ($request) {

        if ($request->phone){
            $q->where('phone','LIKE','%'.$request->phone.'%');
        }

        if ($request->code){
            $q->where('code','LIKE','%'.$request->code.'%');
        }
        if ($request->name){
            $q->where('name','LIKE','%'.$request->name.'%');
        }
    })
    ->paginate();
    return view('admin.orders.pending.index', compact('records'));
  }

  public function showPendingOrder($id){
    $order = Order::findOrFail($id);
    $products = $order->products()->paginate();
    return view('admin.orders.pending.show', compact('order', 'products'));

  }

  public function acceptPendingOrder($id){
    $record = Order::findOrFail($id);
    $record->update(['status' => 'inProgress']);
    $record->save();
    Log::createLog($record, auth()->user(), 'عملية قبول طلب معلق', ' قبول طلب #' . $record->id);
    session()->flash('success', 'تم القبول بنجاح');
    return redirect()->route('orders.pending');
  }

  // pending orders functions end

  // inProgress functions start
  public function inProgressOrders (Request $request){
    $records = Order::where('status', 'inProgress')
    ->where(function ($q) use ($request) {

        if ($request->phone){
            $q->where('phone','LIKE','%'.$request->phone.'%');
        }

        if ($request->code){
            $q->where('code','LIKE','%'.$request->code.'%');
        }
        if ($request->name){
            $q->where('name','LIKE','%'.$request->name.'%');
        }
    })
    ->paginate();
    return view('admin.orders.inProgress.index', compact('records'));
  }

  public function showInProgressOrder($id){
    $order = Order::findOrFail($id);
    $products = $order->products()->paginate();
    return view('admin.orders.inProgress.show', compact('order', 'products'));

  }

  public function acceptInprogressOrder($id){
    $record = Order::findOrFail($id);
    $record->update(['status' => 'ready']);
    $record->save();
    Log::createLog($record, auth()->user(), 'عملية قبول طلب قيد التنفيذ', ' قبول طلب #' . $record->id);
    session()->flash('success', 'تم القبول بنجاح');
    return redirect()->route('orders.inProgress');

    }

    //inprogress functions end


    // ready orders functions start
    public function readyOrders (Request $request){
        $records = Order::where('status', 'ready')
        ->where(function ($q) use ($request) {

            if ($request->phone){
                $q->where('phone','LIKE','%'.$request->phone.'%');
            }

            if ($request->code){
                $q->where('code','LIKE','%'.$request->code.'%');
            }
            if ($request->name){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
        })
        ->paginate();
        return view('admin.orders.ready-for-delivery.index', compact('records'));
      }

      public function showReadyOrder($id){
        $order = Order::findOrFail($id);
        $products = $order->products()->paginate();
        return view('admin.orders.ready-for-delivery.show', compact('order', 'products'));

      }

      public function acceptReadyOrder($id){
        $record = Order::findOrFail($id);
        $record->update(['status' => 'delivered']);
        $record->save();
        Log::createLog($record, auth()->user(), 'عملية قبول طلب جاهز للشحن ', ' قبول طلب #' . $record->id);
        session()->flash('success', 'تم القبول بنجاح');
        return redirect()->route('orders.ready');

        }
    //ready functions end

    //delivering orders functions start
    public function deliveringOrders (Request $request){
        $records = Order::where('status', 'delivered')
        ->where(function ($q) use ($request) {

            if ($request->phone){
                $q->where('phone','LIKE','%'.$request->phone.'%');
            }

            if ($request->code){
                $q->where('code','LIKE','%'.$request->code.'%');
            }
            if ($request->name){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
        })
        ->paginate();
        return view('admin.orders.delivering.index', compact('records'));
      }

      public function showDeliveringOrder($id){
        $order = Order::findOrFail($id);
        $products = $order->products()->paginate();
        return view('admin.orders.delivering.show', compact('order', 'products'));

      }

      public function acceptDeliveringOrder($id){
        $record = Order::findOrFail($id);
        $record->update(['status' => 'received']);
        $record->save();
        Log::createLog($record, auth()->user(), 'عملية قبول طلب قيد الشحن', ' قبول طلب #' . $record->id);
        session()->flash('success', 'تم القبول بنجاح');
        return redirect()->route('orders.delivering');

        }

    // delivering funcrions end

    //received orders functions start
    public function receivedOrders (Request $request){
        $records = Order::where('status', 'received')
        ->where(function ($q) use ($request) {

            if ($request->phone){
                $q->where('phone','LIKE','%'.$request->phone.'%');
            }

            if ($request->code){
                $q->where('code','LIKE','%'.$request->code.'%');
            }
            if ($request->name){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
        })
        ->paginate();
        return view('admin.orders.received.index', compact('records'));
      }

      public function showReceivedOrder($id){
        $order = Order::findOrFail($id);
        $products = $order->products()->paginate();
        return view('admin.orders.received.show', compact('order', 'products'));

      }
      
            //received orders end

      //canceled orders functions start

      public function canceledOrders(Request $request){
        $records = Order::where('status', 'canceled')
        ->where(function ($q) use ($request) {

            if ($request->phone){
                $q->where('phone','LIKE','%'.$request->phone.'%');
            }

            if ($request->code){
                $q->where('code','LIKE','%'.$request->code.'%');
            }
            if ($request->name){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
        })
        ->paginate();
        return view('admin.orders.canceled.index', compact('records'));

      }

      public function showCanceledOrder($id){
        $order = Order::findOrFail($id);
        $products = $order->products()->paginate();
        return view('admin.orders.canceled.show', compact('order', 'products'));

      }

      public function canceledOrderAccept($id){
        $record = Order::findOrFail($id);
        if($record->status == 'rejcted'){
            session()->flash('success', 'تم القبول بنجاح');
            return redirect()->route('orders.canceled');    
        }

        $record->update(['status' => 'rejected']);

        $orderProducts = $record->products()->get();
        foreach ($orderProducts as $orderProduct){            
            $product = Product::findorfail($orderProduct->product_id);
            $supplier = $product->supplier()->first();
            $categoryPrice=$product->subCategory->price;
            $supplierProfit= $orderProduct->price - $categoryPrice;
            $profit= $supplierProfit * $orderProduct->quantity;
            $supplier->allProfit=$supplier->allProfit - $profit ;
            $supplier->availableProfit=$supplier->availableProfit - $profit;
            $supplier->save();

             $product->update([
                 'saledQuantity'=>$product->saledQuantity - $orderProduct->quantity,
             ]);
            //check if product has quantity or not , and increase quantity if has .

             if($product->availableQuantity > 0 ){
                $product->update([
                   'availableQuantity'=> $product->availableQuantity - $orderProduct->quantity,
                ]);
            }
        }

        

        Log::createLog($record, auth()->user(), 'عملية قبول طلب ملغي', ' قبول طلب #' . $record->id);
        session()->flash('success', 'تم القبول بنجاح');
        return redirect()->route('orders.canceled');

        }
        
          public function paymob(){
            $records = Paymob::paginate(25);    
            // dd($records->first()->order()->first());
            return view('admin.orders.paymob.index', compact('records'));
        }
    
      

    

}






