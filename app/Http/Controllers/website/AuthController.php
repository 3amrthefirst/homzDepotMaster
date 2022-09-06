<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\User;
use Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;


class AuthController extends Controller
{
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 15; // Default is 1
    // needs to be reviewed
    public function viewSignup(Request $request)
    {
        return view('website.auth.signup');
    }
    public function signup(Request $request)
    {

        $rules = [
            'email' => 'required|unique:customers,email|email',
            'password' => 'confirmed|required|min:6',
            'fname' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|size:11',
            'lname'=>'required',
        ];

        $message = [
            'fname.required' => 'الأسم الاول مطلوب',
            'lname.required' => 'الأسم الأخير مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'phone.regex' => ' رقم التليفون غير صحيح',
            'phone.size' => ' رقم التليفون غير صحيح',
            'email.unique'=>'هذا اللأيميل مسجل بالفعل',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'الحد الادني لكلمه المرور 6 حروف',
            'password.confirmed'=>'كلمه المرور غير متطابقه',

        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        } else {
            $request->merge(['password' => bcrypt($request->password)]);
                Customer::create($request->all());
                return redirect()->route('viewLogin');
        }
    }
    public function viewLogin()
    {
        return view('website.auth.login');
    }


    public function login(Request $request)
    {
                $rules = [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required'
        ];

        $message = [
            'email.required' => 'البريد الإلكترني مطلوب',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'email.exists' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'password.required' => 'كلمة المرور مطلوبة'
        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        } else {
            $remember = $request->input('remember') && $request->remember == 1 ? $request->remember : 0;
            if (auth()->guard('web')->attempt(['email' => $request->email , 'password' => $request->password], $remember)) {
                 cart::restore(auth()->id());
                return redirect()->route('home');
            } else {
                return back()->withInput()->withErrors(['error' => 'خطأ في البريد الإلكتروني أو كلمة المرور']);
            }
        }
    }
    public function customerLogout(Request $request)
    {
        Cart::store(auth()->id());
        Cart::destroy();
        Auth::logout();

        return redirect()->route('home');
    }
    public function resetPassword()
    {


        return view('website.auth.reset');

    }
    public function pinCheck()
    {
        return view('website.auth.pinCheck');
    }

    public function changePass()
    {
        return view('website.auth.change-pass');

    }


    public function checkEmail(Request $request)
    {

        $rules = ([
            'email' => 'required|email|exists:customers,email',

        ]);
        $message = [
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.exists' => 'البريد الالكتروني غير مسجل لدينا في قواعد البيانات',
        ];

        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withErrors($data->errors())->withInput();
        }

        $pinCode = rand(111111,999999);
        $mark = Customer::whereEmail($request->email)->first();
        $mark->pin_code = $pinCode ;
        $mark->save();
             \Session::put('email', $mark->email);
            if ($mark)
            {

                Mail::to($mark->email)

                    ->bcc("no-replay@homezdepot.com")
                    ->send(new ResetPassword($pinCode));
                session()->flash('success', __('تم  ارسال الكود بنجاح'));

                return redirect()->route('pin-code-check');

            }else{
                return  back();
            }

    }


    public function checkCode(Request $request)
    {


       $markEmail =  \Session::get('email');
        $rules = ([
            'pin_code' => 'required',

        ]);
        $message = [
            'pin_code.required' => 'الكود مطلوب',
//            'pin_code.exists' => 'الكود غير مسجل لدينا في قواعد البيانات',
        ];

        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails())
        {
            return back()->withErrors($data->errors())->withInput();
        }

        $mark = Customer::whereEmail($markEmail)->first();
        if ($mark)
        {
            if ($mark->pin_code == $request->pin_code)
            {
                session()->flash('success', __('تم التحقق من الكود يمكنك الان تغير كلمه المرور'));
                return redirect()->route('change-pass');
            }else{
                session()->flash('error', __('حدث خطآ يرجي المحاوله مره اخري'));
                return redirect()->route('pin-code-check');
            }
        }
    }


    public function changPassMark(Request $request)
    {
        $markEmail =  \Session::get('email');
        $rules = ([
            'password' => 'confirmed|required|min:6',

        ]);
        $message = [
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'الحد الادني لكلمه المرور 6 حروف',
            'password.confirmed'=>'كلمه المرور غير متطابقه',
        ];

        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails())
        {
            return back()->withErrors($data->errors())->withInput();
        }

        $mark = Customer::whereEmail($markEmail)->first();

        $hashedPassword =$mark->password;
            if (!\Hash::check($request->password, $hashedPassword)) {
                $newpassword = bcrypt($request->password);
                $mark->update(["password" =>  $newpassword]);
                session()->flash('success', __('تم تغير كلمه المرور بنحاح'));
                return redirect('/logout');
            } else {
//
                 session()->flash('error', "كلمه المرور الجديده لا يمكن ان تكون مثل القديمه");
                 return redirect()->back();
            }
    }





}
