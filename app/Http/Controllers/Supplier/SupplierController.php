<?php

namespace App\Http\Controllers\supplier;

use App\MyHelper\Helper;
use App\MyHelper\Photo;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\User;
use Response;
use Hash;
use Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/


    public function updateProfileView()
    {
        return view('manager.update-profile');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            Photo::updatePhoto($request->file('photo'), $user->attachment, $user, 'admins', 'attachment');
        }

        if ($request->input('old-password')) {
            $this->validate($request, [
                'old-password' => 'required',
                'password' => 'required|confirmed',
            ]);

            if (Hash::check($request->input('old-password'), $user->password)) {
                // The passwords match...
                $user->password = bcrypt($request->input('password'));
                $user->save();
            } else {
                session()->flash('fail', 'كلمة المرور غير صحيحة');
                return view('manager.update-profile');
            }
        }

//        Log::createLog($user , auth()->user() , 'تعديل بيانات البروفايل الخاص به #' . $user->id);
        session()->flash('success', __('تم التعديل بنجاح'));
        return redirect('manager/update-profile');
    }

    public function index(Request $request)
    {
        $users = User::where(function ($q) use ($request) {
            if ($request->id) {
                $q->where('id', $request->id);
            } else {
                if ($request->name) {
                    $q->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->name . '%')
                           ->orWhere('email', 'LIKE', '%' . $request->name . '%');
                    });
                }
                if ($request->role_name) {
                    $q->whereHas('roles', function ($q) use ($request) {
                        $q->where('display_name', 'LIKE', '%' . $request->role_name . '%');
                    });
                }

                if ($request->from) {
                    $q->whereDate('created_at', '>=', Helper::convertDateTime($request->from));
                }

                if ($request->to) {
                    $q->whereDate('created_at', '<=', Helper::convertDateTime($request->to));
                }
            }

            if (!auth()->user()->hasRole('Technical Support')) {
                $q->where('id', '!=', 1);
            }
        })->latest()->paginate(20);
        return view('manager.users.index', compact('users'));
    }

    public function create(User $model)
    {
        $model = new User();
        $roles = Role::all();

        return view('manager.users.create', compact('model', 'roles'));
    }

    public function store(Request $request)
    {
        $rules =
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'roles.*' => 'required|exists:roles,id',
            ];

        $error_sms =
            [
//                'name.required' => 'الرجاء ادخال الاسم ',
//                'email.unique' => ' البريد الالكتروني موجود بالفعل',
//                'email.required' => 'الرجاء ادخال البريد الالكتروني',
//                'password.required' => 'الرجاء ادخال كلمة المرور',
//                'password.confirmed' => 'الرجاء التاكد من كلمة المرور ',

            ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }
        $user = User::create(request()->all());

        $user->update(['password' => Hash::make($request->password)]);

        $user->assignRole($request->roles);

        // update governorates roles
//        $user->governorates()->sync($request->governorates);

//        Log::createLog($user , auth()->user() , 'إضافة مستخدم لوحة تحكم #' . $user->id);
        session()->flash('success', __('تم الاضافة بنجاح'));
        return redirect('/manager/user');
    }

    public function show($id)
    {
        /* $user = User::with('addresses')->findOrFail($id);
         $orders = $user->orders()->latest()->paginate(5);
         return view('admin.sushi.user',compact('user','orders'));*/
    }

    public function edit($id)
    {
        $model = User::findOrFail($id);
        $roles = Role::all();


        return view('manager.users.edit', compact('model', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $record = User::findOrFail($id);

        $rules =
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $record->id . '',
                'password' => 'confirmed',
                'roles.*' => 'required|exists:roles,id',
            ];

        $error_sms =
            [
//                'name.required' => 'الرجاء ادخال الاسم ',
//                'email.required' => 'الرجاء ادخال البريد الالكتروني',
//                'email.unique' => ' البريد الالكتروني موجود بالفعل',
//                'password.required' => 'الرجاء ادخال كلمة المرور ',
//                'password.confirmed' => 'الرجاء التاكد من كلمة المرور ',

            ];
        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return redirect('/manager/user/' . $id . '/edit')->withInput()->withErrors($data->errors());
        }


        $record->update($request->except('password'));

        if ($request->password) {
            $record->update(['password' => Hash::make($request->password)]);
        }

        // DB::table('model_has_roles')->where('model_id', $id)->delete();
        // $record->assignRole($request->roles);
        if (count((array)$request->roles)) {
            $record->syncRoles($request->roles);
        }


        // update governorates roles
//        $record->governorates()->sync($request->governorates);

//        Log::createLog($record , auth()->user() , 'تعديل بيانات مستخدم لوحة تحكم #' . $record->id);
        session()->flash('success', __('تم التعديل بنجاح'));
        return redirect('/manager/user');
    }

    public function destroy($id)
    {
        $record = User::findOrFail($id);

        if (auth('web')->user()->id == $record->id) {
            session()->flash('fail', 'This email, you cannot deactivate it');
            return redirect('manager/users');
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $record->delete();
        $data = [
            'status' => 1,
            'msg' => __('تم الحذف بنجاح'),
            'id' => $id
        ];

//        Log::createLog($record , auth()->user() , 'حذف مستخدم لوحة تحكم #' . $record->id);
        return Response::json($data, 200);
    }

    public function activation($id)
    {
        $record = User::findOrFail($id);

        if (auth('web')->user()->id == $record->id) {
            session()->flash('fail', 'This email, you cannot deactivate it');
            return redirect('manager/user');
        }
        $activate = Helper::activation($record);

        if ($activate) {

//            if($record->activation == 1)
//            {
            ////                Log::createLog($record , auth()->user() , 'تفعيل مستخدم لوحة تحكم #' . $record->id);
//            }else{
//
            ////                Log::createLog($record , auth()->user() , 'إلغاء تفعيل مستخدم لوحة تحكم #' . $record->id);
//            }
            session()->flash('success', 'success');
            return redirect('manager/user');
        }


        session()->flash('fail', 'Something went wrong please try again');
        return redirect('manager/user');
    }

    public function home()
    {
        return view('manager.layouts.home');
    }
}
