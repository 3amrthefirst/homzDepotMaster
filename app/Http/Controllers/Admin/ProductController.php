<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Product;
use App\MyHelper\Helper;
use Helper\Attachment;
use Response;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->model = new Product();
    }


//start of functions for pending products

public function indexForPendingProducts(Request $request){
    $records = $this->model->where(function ($query) use ($request) {
        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->code) {
            $query->where('code', 'LIKE', '%' . $request->code . '%');
        }
        if ($request->supplier) {
            $query->where('supplier_id', $request->supplier);
        }
    })
    ->where('status','pending')
    ->latest()->paginate();

    return view('admin.products.pending.index', compact('records'));
}

public function showPendingProduct($id){
    $data = $this->model->findOrFail($id);
    return view('admin.products.pending.show', compact('data'));


}

//accept mean product will be available for use in website and his state is 'accepted'
public function acceptPendingProduct($id){

    $record = $this->model->findOrFail($id);
    $record->update(['status'=>'accepted']);
    Log::createLog($record, auth()->user(), 'عملية قبول', ' قبول منتج #' . $record->id);
    session()->flash('success', 'تم القبول بنجاح');
    return redirect()->route('products.pending');


}
//reject mean product will not be used and returned to supplier with the reason of rejected
public function rejectPendingProduct($id, Request $request){

    $rules = ['reason' => 'required'];
    $data = validator()->make($request->all(), $rules);
    if ($data->fails()) {
        session()->flash('error', 'عملية رفض غير ناجحه أعد المحاوله');

        return back()->withErrors($data->errors())->withInput();
    }

    $record = $this->model->findOrFail($id);
    $record->update(['status' => 'rejected']);
    $record->save();
    $reason = $request->reason;
    $record->reason()->create([
        'message' => $reason,
        'product_id' => $record->id,
    ]);

    Log::createLog($record, auth()->user(), 'عملية رفض', ' رفض منتج #' . $record->id);
    session()->flash('success', 'تم الرفض بنجاح');
    return redirect()->route('products.pending');
}
//end of functions for pending products.

//start functions for accepted products

public function index(Request $request)
{
    $records = $this->model->where(function ($query) use ($request) {
        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->code) {
            $query->where('code', 'LIKE', '%' . $request->code . '%');
        }
        if ($request->supplier) {
            $query->where('supplier_id', $request->supplier);
        }
    })
    ->where('status','accepted')
    ->latest()->paginate();

    return view('admin.products.accepted.index', compact('records'));

}

public function show($id)
{
    $data = $this->model->findOrFail($id);
    return view('admin.products.accepted.show', compact('data'));

}

public function edit($id)
{
    $model = $this->model->findOrFail($id);
    return view('admin.products.accepted.edit', compact('model'));
}
public function update(Request $request ,$id )
  {

    $product = Product::findorfail($id);

    $rules = [
      'name' => 'required',
      'price' => 'required|numeric',
      'original_quantity' => 'numeric|nullable',
      'colorName'=>'required',
      'attachments' => 'nullable|array',

  ];
  $msgs=[
    'name.required'=>"يجب ادخال اسم المنتج",
    'price.required'=>'يجب ادخال السعر',
    'original_quantity.required'=>'الكميه يجب ان تكون ارقام',
    'colorName.required'=>'يجب تحديد اللون',
  ];

  $data = validator()->make($request->all(), $rules,$msgs);

  if ($data->fails()) {
      return back()->withErrors($data->errors())->withInput();
  }
  else{
    $product->update($request->all());
    if (!empty($request->attachments) && count($request->attachments)) {
      $count = 0;
      foreach ($request->attachments as $attachment) {
          Attachment::addAttachment($request->file('attachments')[$count], $product, 'product/attachments', ['save' => 'original']);
          $count++;
      }
  }
  Log::createLog($product, auth()->user(), 'عملية تعديل', ' تعديل منتج #' . $product->id);
  session()->flash('success', 'تمت تحديث بنجاح');
  return redirect()->back();
  }
  }

public function destroy($id)
{
    $record = $this->model->findOrFail($id);
        $record->delete();

        $data = [
            'status' => 1,
            'message' => 'تم الحذف بنجاح',
            'id' => $id,
        ];
        Log::createLog($record, auth()->user(), 'عملية حذف', ' حذف منتج #' . $record->name);
        return Response::json($data, 200);

}

//for activcate product on website 'make it visible'
public function toggleBoolean($id, $action)
{
    $record = $this->model->findOrFail($id);
    Helper::toggleBoolean($record, $action);
    if ($record->$action == 1) {
        Log::createLog($record, auth()->user(), 'عملية تفعيل', 'تفعيل  منتج #'.$record->id);
    } else {
        Log::createLog($record, auth()->user(), 'عملية الغاء تفعيل ', 'الغاء تفعيل  منتج #'.$record->id);
    }

    return Helper::responseJson(1, 'تمت العملية بنجاح');
}


//end of functions for accepted products.

//start of functions for products out of stock
public function indexForProductsOutOfStock(Request $request){
    $records = $this->model->where(function ($query) use ($request) {
        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->code) {
            $query->where('code', 'LIKE', '%' . $request->code . '%');
        }
        if ($request->supplier) {
            $query->where('supplier_id', $request->supplier);
        }
    })
    ->where('status','accepted')
    ->where('availableQuantity','<',6)
    ->latest()->paginate();
    return view('admin.products.out-of-stock.index',compact('records'));

}

//end of functions for products out of stock
}
?>
