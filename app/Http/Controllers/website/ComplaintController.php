<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function contactUs(){
        return view('website.contact-us');
    }

    public function storeData(Request $request){
        $rules = [
            'phone' => 'required',
            'message' => 'required'
        ];

        $msg = [
            'phone.required' => 'يجب ادخال رقم الهاتف',
            'message.required' => 'يجب ادخال الرسالة ',
        ];
        $data = validator()->make($request->all(), $rules, $msg);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }
        Complaint::create([
            'customer_id'=> auth()->id(),
            'phone' => $request->phone,
            'message' => $request->message
        ]);
        session()->flash('success','تم الارسال بنجاح');
        return redirect()->route('home')->withInput()->withErrors(['success' => 'تم الارسال بنجاح']);

    }
}
