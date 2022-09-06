<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddQuantity;
use App\Models\Product;
use Auth;

class AddQuantityController extends Controller
{
  protected $model;
  public function __construct()
  {
      $this->model = new AddQuantity();
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function addQ(request $request)
  {

      $rules = [
         'quantity'=>'required|numeric'
      ];

      $message = [
          'quantity.required' => ' الكميه مطلوب',
          
          
      ];


      $data = validator()->make($request->all(), $rules, $message);

      if ($data->fails()) {
          return back()->withInput()->withErrors($data->errors());
      } else {
         
              $product=Product::findorfail($request->id);
              $request->merge(['product_id'=>$product->id,
          'supplier_id'=>Auth::guard('supplier')->id()]);
           $this->model->create($request->all());
           session()->flash('success', __(' تم ارسال طلب الاضافه بنجاح'));
          return redirect()->back();
          
      }
  }
  public function index()
  {
    $records = $this->model->where('supplier_id',auth()->id())->latest()->paginate();
      return view('supplier.products.addQuantity.index',compact('records'));
    
  }
  public function update($id ,Request $request)
  {
    $rules = [
        'quantity'=>'required|numeric'
     ];

     $message = [
         'quantity.required' => ' الكميه مطلوب',
         
         
     ];


     $data = validator()->make($request->all(), $rules, $message);

     if ($data->fails()) {
         return back()->withInput()->withErrors($data->errors());
     } else {
         $record=$this->model->findorfail($id);
         $record->update($request->all());
         session()->flash('success', __(' تم تعديل طلب الاضافه بنجاح'));
         return redirect()->back();
          
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
  
  public function rejected()
  {
    $records = $this->model->where('supplier_id',auth()->id())->where('status','rejected')->latest()->paginate();
      return view('supplier.products.addQuantity.rejected',compact('records'));
    
  }

}

?>
