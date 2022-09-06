<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Log;

class RefundController extends Controller
{
  protected $model;
  protected $viewsDomain = 'admin.refunds.';
  public function __construct()
  {
      $this->model = new Refund();
  }


  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $records =Refund::where(function ($query) use ($request) {
        if ($request->name) {
            $query->where('customerName', 'LIKE', '%' . $request->name . '%');
            if ($request->phone) {
                $query->where('phone', 'LIKE', '%' . $request->phone . '%');
            }
        }
       })
    ->latest()->paginate();
    return view('admin.orders.received.refunds.index',compact('records'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request,$order_id)
  {
        $rules =
            [
                'date' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'phone' => 'required',

            ];

        $error_sms =
            [
                'date.required' => 'الرجاء ادخال التاريخ ',
                'quantity.required' => 'الرجاء ادخال الكمية  ',
                'price.required' => 'الرجاء ادخال السعر ',
                'phone.required' => 'الرجاء ادخال رقم الهاتف ',
            ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            session()->flash('error', ' فشل الاضافة');
            return back()->withInput()->withErrors($data->errors());
        }

        //check if order exists in refund table or not
        $refunds = Refund::pluck('order_id')->toArray();
        if(!in_array($order_id, $refunds)) {
            $this->model->create([
                'date' => $request->date,
                'address' => $request->address,
                'order_id' => $order_id,
                'phone' => $request->phone,
                'customerName' =>$request->customerName ,


            ]);
        }

            $refund = Refund::where('order_id',$order_id)->first();
            $record = $refund->products()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'supplier_id'=>$request->supplierId,


            ]);

        //store refund on supplier table
        $product = Product::findOrFail($request->product_id);
        $product->supplier()->update([
            'allRefundProfit' => $product->supplier->allRefundProfit + $request->price,
            'refundProfit' => $product->supplier->refundProfit + $request->price,
        ]);

        //check if product has quantity or not, and decrease it if has.
       if($product->original_quantity > 0){
            $product->update([
                'availableQuantity' => $product->availableQuantity + $request->quantity,
            ]);
        }
        $product->update([
           
            'saledQuantity' => $product->saledQuantity - $request->quantity,
            'refundQuantity'=>$product->refundQuantity + $request->quantity
        ]);

        Log::createLog($record, auth()->user(), 'عملية اضافة', ' اضافة مسترجع #' . $record->id);
        session()->flash('success', 'تمت الاضافة بنجاح');
        return back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      
      $order = $this->model->findOrFail($id);
      $products = $order->products()->get();
      return view('admin.orders.received.refunds.show',compact('order','products'));

  }

}

?>
