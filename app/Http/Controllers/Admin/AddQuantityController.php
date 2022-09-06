<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AddQuantity;
use App\Http\Controllers\Controller;
use App\Models\Log;
class AddQuantityController extends Controller
{


    public function pendingAddQuantityFormProduct(Request $request){
        $records = AddQuantity::whereHas('supplier',function($q) use ($request){
            if ($request->supplier){
                $q->where('name','LIKE','%'.$request->supplier.'%');
            }
        })
        ->whereHas('product',function($q) use ($request){
            if ($request->name){
                $q->where('name','LIKE','%'.$request->name.'%');
            }
            if ($request->code){
                $q->where('code','LIKE','%'.$request->code.'%');
            }

        })
        ->where('status','pending')
        ->latest()->paginate();
        return view('admin.store.add-quantity.index',compact('records'));


    }

    public function showAddQuantityProduct($id){

        $record = AddQuantity::findOrFail($id);
        $data = $record->product()->first();

        return view('admin.store.add-quantity.show',compact('record','data'));

    }

    public function acceptPendingAddQuantityFormProduct($id){
        $record = AddQuantity::findOrFail($id);
        $product = $record->product()->first();
        $product->update([
            'availableQuantity' => $product->availableQuantity + $record->quantity
        ]);

        $record->update(['status' => 'accepted']);
        Log::createLog($record, auth()->user(), 'عملية قبول', ' قبول اضافة كمية #' . $record->id);
        session()->flash('success', 'تم القبول بنجاح');
        return redirect()->route('store.add-quantity');


    }
     public function rejectPendingAddQuantityFormProduct($id, Request $request){

        $rules = ['reason' => 'required'];
        $data = validator()->make($request->all(), $rules);
        if ($data->fails()) {
            session()->flash('error', 'عملية رفض غير ناجحه أعد المحاوله');

            return back()->withErrors($data->errors())->withInput();
        }

        $record = AddQuantity::findOrFail($id);
        $record->update(['status' => 'rejected']);
        $record->save();
        $record->reason()->create([
            'message' => $request->reason,
            'add_quantity_id' => $record->id,
        ]);

        Log::createLog($record, auth()->user(), 'عملية رفض', ' رفض اضافة كمية #' . $record->id);
        session()->flash('success', 'تم الرفض بنجاح');
        return redirect()->route('store.add-quantity');
    }

}

?>
