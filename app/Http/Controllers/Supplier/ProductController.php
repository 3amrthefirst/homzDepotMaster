<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Product;
use App\MyHelper\Helper;
Use Auth;
use Helper\Attachment;

class ProductController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   *
   */
  protected $model;
  protected $viewsDomain = 'supplier.products.';
  public function __construct()
  {
      $this->model = new Product();
  }

  private function view($view, $params = [])
  {
      return view($this->viewsDomain.$view, $params);
  }
  public function index(Request $request)
  {

    $records = $this->model->where('supplier_id',auth()->id())->where(function ($query) use ($request) {
      if ($request->name) {
          $query->where('name', 'LIKE', '%' . $request->name . '%');
      }
      if ($request->code) {
          $query->where('code', 'LIKE', '%' . $request->code . '%');
      }

  })->latest()->paginate();

    return $this->view('index', compact('records'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    // $categories = Category::all();
    $model = $this->model;
    return $this->view('create', compact('model'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $rules = [
      'name' => 'required|unique:products',
      'subCategory_id' => 'nullable',
      'category_id' => 'required',
      'subCategory_id' => 'required',
      'price' => 'required|numeric',
      'discountValue' => 'nullable|numeric|Lt:price',
      'discountPercent' => 'nullable|numeric',
      'original_quantity' => 'numeric|nullable',
      'receivedTime'=>'required',
      'colorName'=>'required',
      'attachments' => 'required|array',
  ];
  $msgs=[
    'name.required'=>"يجب ادخال اسم المنتج",
    'name.unique'=>'الاسم يجب ان يكون مميز',
    'category_id.required'=>'يجب اختيار القسم الرئيسي',
    'subCategory_id.required'=>'يجب اختيار القسم الفرعي',
    'price.required'=>'يجب ادخال السعر',
    'discountValue.lt'=>"قيمه الخصم يجب ان تكون اقل من السعر",
    'original_quantity.nemuric'=>'الكميه يجب ان تكون ارقام',
    'receivedTime.required'=>'يجب تحديد وقت التسليم',
    'colorName.required'=>'يجب تحديد اللون',
    'attachments.required'=>"يجب رفع صورة للمنتح"
  ];

    $row = Product::orderBy('code', 'desc')->first();
    $code = 0;
    if ($row != null) {
        $last_id = $row->code;
        $id = explode('-', $last_id);
        $id = ++$id[0];
        $name = Auth::user()->name;
        $code = $id.'-'.$name;
    } else {
        $name = Auth::user()->name;
        $code = 'PROD000001-'.$name;
    }
    $data = validator()->make($request->all(), $rules,$msgs);

    if ($data->fails()) {
        return back()->withInput()->withErrors($data->errors());
    } else {
      $request->merge(['supplier_id'=>auth()->user()->id,
    'code'=>$code,
    'availableQuantity'=>$request->original_quantity
      ]);
     $product=Product::create($request->all());
    if (!empty($request->attachments) && count($request->attachments)) {
          $count = 0;
          foreach ($request->attachments as $attachment) {
              Attachment::addAttachment($request->file('attachments')[$count], $product, 'product/attachments', ['save' => 'original']);
              $count++;
          }
      }
      session()->flash('success', 'تمن الأضافه بنجاح');
      return redirect()->route('supplier.products.index');

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
    $record = $this->model->findOrFail($id);
    return view('supplier.products.show', compact('record'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
        $model = $this->model->findOrFail($id);
        return view('supplier.products.edit', compact('model'));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request ,$id )
  {

    $product = Product::findorfail($id);

    $rules = [
      'name' => 'required',
      'price' => 'required|numeric',
      'original_quantity' => 'numeric|nullable',
      'discountValue' => 'nullable|numeric|Lt:price',
      'discountPercent' => 'nullable|numeric',
      'colorName'=>'required',
      'attachments' => 'nullable|array',

  ];
  $msgs=[
    'name.required'=>"يجب ادخال اسم المنتج",
    'price.required'=>'يجب ادخال السعر',
    'discountValue.lt'=>"قيمه الخصم يجب ان تكون اقل من السعر",
    'original_quantity.required'=>'الكميه يجب ان تكون ارقام',
    'colorName.required'=>'يجب تحديد اللون',
  ];

  $data = validator()->make($request->all(), $rules,$msgs);

  if ($data->fails()) {
      return back()->withErrors($data->errors())->withInput();
  }
  else{
   $request->merge([
    'availableQuantity'=>$request->original_quantity,
    'status'=>'pending'
      ]);
    $product->update($request->all());
    if (!empty($request->attachments) && count($request->attachments)) {
      $count = 0;
      foreach ($request->attachments as $attachment) {
          Attachment::addAttachment($request->file('attachments')[$count], $product, 'product/attachments', ['save' => 'original']);
          $count++;
      }
  }
  session()->flash('success', 'تمت تحديث بنجاح');

  return redirect()->route('supplier.products.index');
  }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */

    public function destroy($id)
  {
    $record = $this->model->findOrFail($id);
        $record->delete();
        return response()->json([
          'status' => 1,
          'message' => 'تم الحذف بنجاح',
          'id' => $id,
      ]);

  }
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
public function outofstock(Request $request){
  $records = $this->model->where('supplier_id',auth()->id())->where(function ($query) use ($request) {
      if ($request->name) {
          $query->where('name', 'LIKE', '%' . $request->name . '%');
      }
      if ($request->code) {
          $query->where('code', 'LIKE', '%' . $request->code . '%');
      }

  })->where('status','accepted')->where('availableQuantity','<',6)->latest()->paginate();
  return view('supplier.products.out-of-stock.index',compact('records'));

}
    public function rejectedProducts(Request $request){
    $records = $this->model->where('supplier_id',auth()->id())->where('status','rejected')->where(function ($query) use ($request) {
      if ($request->name) {
          $query->where('name', 'LIKE', '%' . $request->name . '%');
      }
      if ($request->code) {
          $query->where('code', 'LIKE', '%' . $request->code . '%');
      }

  })->latest()->paginate();
    return view('supplier.products.rejectedProducts.rejectedProducts',compact('records'));
  }
  public function rejectedShow($id)
  {
    $record = $this->model->findOrFail($id);
    return view('supplier.products.rejectedProducts.show', compact('record'));

  }



}

?>
