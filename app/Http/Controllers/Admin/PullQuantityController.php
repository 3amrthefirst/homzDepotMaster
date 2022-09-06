<?php

namespace App\Http\Controllers\Admin;
use App\Models\PullQuantity;
use App\Http\Controllers\Controller;
use App\Models\Log;

use Illuminate\Http\Request;

class PullQuantityController extends Controller
{

    public function pendingPullQuantityFormProduct(Request $request){
        $records = PullQuantity::whereHas('supplier',function($q) use ($request){
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
        return view('admin.store.pull-quantity.index',compact('records'));


    }

    public function showPullQuantityProduct($id){

        $record = PullQuantity::findOrFail($id);
        $data = $record->product()->first();

        return view('admin.store.pull-quantity.show',compact('record','data'));

    }

    //accept request mean available quantity of product will decreased
    public function acceptPendingPullQuantityFormProduct($id){
        $record = PullQuantity::findOrFail($id);
        $product = $record->product()->first();
        $product->update([
            'availableQuantity' => $product->availableQuantity - $record->quantity
        ]);

        $record->update(['status' => 'accepted']);
        Log::createLog($record, auth()->user(), 'عملية قبول', ' قبول سحب كمية #' . $record->id);
        session()->flash('success', 'تم القبول بنجاح');
        return redirect()->route('store.pull-quantity');


    }
     public function rejectPendingPullQuantityFormProduct($id, Request $request){

        $rules = ['reason' => 'required'];
        $data = validator()->make($request->all(), $rules);
        if ($data->fails()) {
            session()->flash('error', 'عملية رفض غير ناجحه أعد المحاوله');

            return back()->withErrors($data->errors())->withInput();
        }

        $record = PullQuantity::findOrFail($id);
        $record->update(['status' => 'rejected']);
        $record->save();
        $record->reason()->create([
            'message' => $request->reason,
            'pull_quantity_id' => $record->id,
        ]);

        Log::createLog($record, auth()->user(), 'عملية رفض', ' رفض سحب كمية #' . $record->id);
        session()->flash('success', 'تم الرفض بنجاح');
        return redirect()->route('store.pull-quantity');
    }

}

?>
