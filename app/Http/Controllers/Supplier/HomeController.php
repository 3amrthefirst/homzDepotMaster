<?php

namespace App\Http\Controllers\Supplier;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if(auth()->user()->is_active == 1){
        return view('supplier.layouts.home');
    }
    else{
        Auth::guard('supplier')->logout();
        session()->flash('error','هذا الحساب غير مفعل');
        return redirect('supplier/login')->WithErrors(['email' => 'هذا الحساب غير مفعل']);
    }
    }


}
