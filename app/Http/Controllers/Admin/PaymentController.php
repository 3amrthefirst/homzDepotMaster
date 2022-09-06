<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DB;
use App\Models\Log;

class PaymentController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $records=Supplier::where('availableProfit','>',0)
    ->where(function ($query) use ($request) {

      if ($request->supplier) {
          $query->where('id', $request->supplier);
      }
  })->latest()->paginate();
    return view('admin.payment.index',compact('records'));

  }

  public function allPayments(Request $request)
  {
    $records=Supplier::where(function ($query) use ($request) {

      if ($request->supplier) {
          $query->where('id', $request->supplier);
      }
  })->latest()->paginate();
    return view('admin.payment.allPayments',compact('records'));

  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {



  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $supplier=Supplier::findorfail($request->supplier_id);

      if($request->amount <= 0 ){
        session()->flash('error', 'لايمكن تحويل مبلغ اقل من 1');
        return redirect()->back();
      }
    if($request->amount == $supplier->net_profit){
      $payment=Payment::create([
      'amount'=>$request->amount,
      'supplier_id'=>$supplier->id,
      'refund' => $supplier->refundProfit,
      'websiteProfit' => $supplier->websiteProfit,
      'allAmount' => $supplier->refundProfit + $supplier->websiteProfit + $supplier->net_profit
    ]);

      $supplier->update([
        'withdraw'=>$supplier->withdraw + $request->amount,
        'refundProfit'=>0,
        'availableProfit'=>0
      ]);

      Log::createLog($payment, auth()->user(), 'عملية تحويل', ' تحويل ارباح #' . $payment->id);
      session()->flash('success', 'تمت عمليه التحويل بنجاح');
      return redirect()->back();



    }
    else{
      session()->flash('error', 'المبلغ غير متاوفق مع المبلغ المتوفر للتحويل');

    }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $payments=Payment::where('supplier_id',$id)->latest()->paginate();
    return view('admin.payment.show',compact('payments'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

  }

}

?>
