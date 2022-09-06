<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user=auth()->user();
       $orders= $user->orders;
        return view('website.profile.profile',compact('user','orders'));
    }
    public function addressUpdate(Request $request)
    {
        $rules = [
            'address' => 'required'
        ];

        $message = [
            'address.required' => ' العنوان مطلوب',
           
        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors())->withErrors(['error' => 'فشلت عمليه التعديل']);

        } else {
        $user=Customer::findorfail(auth()->user()->id);
        $user->update($request->all());
        return redirect()->back()->withInput()->withErrors(['success' => 'تم تعديل العنوان ']);
        }
    }
    public function profileUpdate(Request $request){
        $rules = [
            'email' => 'required|email|unique:customers,email,'.\Auth::id().'',
            'password' => 'nullable|confirmed|min:6',
            'phone' => 'required|regex:/(01)[0-9]{9}/|size:11',
            'fname' => 'required',
            'lname'=>'required',
        ];

        $message = [
            'fname.required' => 'الأسم الاول مطلوب',
            'phone.required' => ' رقم التليفون مطلوب',
            'phone.regex' => ' رقم التليفون غير صحيح',
            'phone.size' => ' رقم التليفون غير صحيح',
            'lname.required' => 'الأسم الأخير مطلوب',
            'old-password.required'=>"كلمه المرور القديمه مطلوبه",
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique'=>'هذا اللأيميل مسجل بالفعل',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'password.min' => 'الحد الادني لكلمه المرور 6 حروف',
            'password.confirmed'=>'كلمه المرور غير متطابقه',

        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors())->withErrors(['error' => 'فشلت عمليه التعديل']);;

        } else {
            $user=Customer::findorfail(auth()->user()->id);
          if(auth()->user()->password)
           {
            if ($request->input('old-password')) {
                if (Hash::check($request->input('old-password'), $user->password)) {
                    // The passwords match...
                    if($request->password){
                        $newpassword = bcrypt($request->password);
                        $request->merge(["password" =>  $newpassword]);
                    $user->update($request->all());

                    }
                   
                    $user->update($request->except('password'));


                    return redirect()->back()->withInput()->withErrors(['success' => 'تم تعديل المعلومات الشخصيه']);

                } else {
                    return redirect()->back()->withInput()->withErrors(['error' => 'كلمه المرور غير صحيحه']);
                }
            
            }else{
                return redirect()->back()->withInput()->withErrors(['error' => 'يجب ادخال كلمه المرور القديمه لتعديل المعلومات الشخصيه']);

            }
           }
           else{
            if($request->password){
                $newpassword = bcrypt($request->password);
                $request->merge(["password" =>  $newpassword]);
            $user->update($request->all());

            }
           
            $user->update($request->except('password'));
            return redirect()->back()->withInput()->withErrors(['success' => 'تم تعديل المعلومات الشخصيه']);


           }
    }
}
    
}
