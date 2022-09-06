<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = 'supplier/home';

    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 15; // Default is 1
    // needs to be reviewed
    public function viewLogin()
    {

        return view('supplier.auth.login');
    }


    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:suppliers,email',
            'password' => 'required'
        ];

        $message = [
            'email.required' => 'البريد الإلكترني مطلوب',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'email.exists' => 'هذا الايميل غير مسجل في قواعد البيانات',
            'password.required' => 'كلمة المرور مطلوبة'
        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        } else {
            $remember = $request->input('remember') && $request->remember == 1 ? $request->remember : 0;

            if (auth()->guard('supplier')->attempt(['email' => $request->email , 'password' => $request->password], $remember)) {
                return redirect()->route("supplier.home");
            } else {
                return back()->withInput()->withErrors(['email' => 'خطأ في البريد الإلكتروني أو كلمة المرور']);
            }
        }
    }
    public function supplierLogout(Request $request)
    {
        Auth::guard('supplier')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return Redirect('supplier/login');
    }

    public function editAccount()
    {
        $record = Supplier::findOrFail(auth()->id());
        return view('supplier.account', compact('record'));
    }

    public function updateAccount(Request $request)
    {
        $rules =
            [
                'name'   => 'required',
                'phone'=> 'required |regex:/(01)[0-9]{9}/|unique:suppliers,phone,'.\Auth::id().'',
                'email'   => 'required | email |unique:suppliers,email,'.\Auth::id().'',  //'unique:users,email,'Auth::id()';
                'password'=> 'nullable|min:5|confirmed',
                'oldpassword'=> 'required',



            ];

        $error_sms =
            [
                'name.required' => 'الاسم مطلوب ',
                'email.email'    => 'يجب ادخال صيغة بريد صحيحة',
                'email.unique'    => 'هذا البريد مستخدم من قبل',
                'email.required'    => 'البريد الالكتروني مطلوب',
                'phone.required' => 'رقم الهاتف مطلوب ',
                'phone.unique'    => 'هذا الرقم مستخدم من قبل',
                'password.confirmed' => 'كلمة السر غير متطابقة ',
                'password.min' => 'كلمة السر يجب ان تكون 5 احرف او ارقام ع الاقل ',
                'phone.regex' => 'الهاتف المحمول يجب ان يكون في صيغه صحيحه',
                'oldpassword.required' => 'يجب ادخال كلمة السر لاجراء اي تغيير'



            ];
            
        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $user = Supplier::findOrFail(Auth::id());
    
        //pasword
        $hashedPassword =$user->password;
        if (\Hash::check($request->oldpassword, $hashedPassword)) {
            if (! $request->password) {
                $user->update($request->except('password'));
                session()->flash("success", 'تم تعديل معلومات الحساب بنجاح');
                return redirect()->route('supplier.home');
            } else {
                if (!\Hash::check($request->password, $hashedPassword)) {
                    $newpassword = bcrypt($request->password);
                    $request->merge(["password" =>  $newpassword]);
                    $user->update($request->all());
                    session()->flash("success", 'تم تعديل معلومات الحساب بنجاح');
                    return redirect()->route('supplier.home');
                } else {
                    session()->flash('error', "كلمة السر الجديده مطابقة لكلمة السر الجديده ");
                    return redirect()->route('supplier.home');
                }
            }
        } else {
            session()->flash('error', 'كلمة السر القديمة غير صحيحة');
            return redirect()->route('supplier.home');
        }
    }
}
