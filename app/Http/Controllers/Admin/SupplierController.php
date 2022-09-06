<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use App\MyHelper\Helper;
use App\Models\Log;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    use OfferTrait;

    protected $model;
    protected $viewsDomain = 'admin/supplier.';

    public function __construct()
    {
        $this->model = new Supplier();
    }

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $this->model->where(function ($q) use ($request) {
            if ($request->phone) {
                $q->where('phone', 'LIKE', '%' . $request->phone . '%');
            }
            if ($request->name) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })
            ->latest()
            ->paginate();
        return $this->view('index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $model = $this->model;
        return $this->view('create', compact('model', 'edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|unique:suppliers,email|email',
            'password' => 'confirmed|required|min:6',
            'name' => 'required',
            'phone' => 'numeric|required',
            'adminProfit' => 'required',
            'code' => 'required'
        ];

        $message = [
            'name.required' => 'الأسم مطلوب',
            'email.required' => 'البريد الإلكترني مطلوب',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'الحد الادني لكلمه المرور 6 حروف',
            'password.confirmed' => 'كلمه المرور غير متطابقه',
            'number.required' => 'الهاتف المحمول مطلوب',
            'adminProfit.required' => 'نسبة الموقع  مطلوبة',
            'number.numeric' => 'الهاتف المحمول يجب ان يكون ارقام',
            'email.unique' => "البريد الاكتروني يجب ان يكون مميز",
            'number.required' => 'الهاتف المحمول مطلوب',
            'code.required' => 'يجب ادخال كود المورد '
        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        } else {
            $supplier = $this->model->create($request->all());
            $supplier->password = bcrypt($request->password);
            $supplier->save();
            session()->flash('success', __('تم الاضافة بنجاح'));
            return redirect('admin/suppliers');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model;
        $supplier = $model->findorfail($id);
        $records = $supplier->products()->paginate();
        return $this->view('products', compact('supplier', 'records'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = $this->model->findOrFail($id);
        $edit = true;
        return $this->view('edit', compact('supplier', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'email' => 'required|email|email',
            'password' => 'confirmed',
            'name' => 'required',
            'adminProfit' => 'required',
            'phone' => 'numeric|required',
            'code' => 'required'

        ];

        $message = [
            'name.required' => 'الأسم مطلوب',
            'email.required' => 'البريد الإلكترني مطلوب',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمه المرور غير متطابقه',
            'number.required' => 'الهاتف المحمول مطلوب',
            'number.numeric' => 'الهاتف المحمول يجب ان يكون ارقام',
            'adminProfit.required' => 'نسبة الموقع  مطلوبة',
            'email.unique' => "البريد الاكتروني يجب ان يكون مميز",
            'number.required' => 'الهاتف المحمول مطلوب',
            'code.required' => 'كود المورد مطلوب'

        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        } else {
            $record = $this->model->findOrFail($id);
            $record->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adminProfit' => $request->adminProfit,
                'code' => $request->code,
            ]);

            if ($request->password != null) {
                $hashedPassword = $record->password;
                if (\Hash::check($request->oldpassword, $hashedPassword)) {
                    if (!\Hash::check($request->password, $hashedPassword)) {
                        $users = Supplier::find($id);
                        $users->password = bcrypt($request->password);
                        Supplier::where('id', $record->id)->update(array('password' =>  $users->password));

                        session()->flash('success', 'تم تحديث البيانات بنجاح');
                        Log::createLog($record, auth()->user(), 'عملية تعديل', ' تعديل مورد #' . $record->id);
                        return redirect()->back();
                    } else {
                        session()->flash('error', 'لا ان تكون كلمة السر الجديده مطابقة للقديمة');
                        return redirect()->back();
                    }
                } else {
                    session()->flash('error', 'كلمة السر القديمه غير صحيحه ');
                    return redirect()->back();
                }
            }

            session()->flash('success', 'تم تحديث البيانات بنجاح');
            Log::createLog($record, auth()->user(), 'عملية تعديل', ' تعديل مورد #' . $record->id);
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
    }

    public function supplierProducts($id, Request $request)
    {
        $supplier = Supplier::findOrFail($id);
        $records = $supplier->products()
            ->where(function ($q) use ($request) {
                if ($request->name) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%');
                }
                if ($request->code) {
                    $q->where('code', 'LIKE', '%' . $request->code . '%');
                }
            })
            ->paginate();
        return view('admin.supplier.products.products', compact('supplier', 'records'));
    }

    public function activateAllDiscountValue($id)
    {

        $supplier = Supplier::findOrFail($id);
        $records = $supplier->products()->get();
        foreach ($records as $record) {
            $record->update([
                'discountValueStatus' => 1,
                'discountPercentStatus' => 0
            ]);
        }
        session()->flash('success', 'تم تفعيل قيم الخصم  بنجاح');
        Log::createLog($record, auth()->user(), 'عملية تفعيل', ' تفعيل قيم الخصم للمورد  #' . $supplier->id);
        return redirect()->back();
    }
    public function activateAllDiscountPercent($id)
    {

        $supplier = Supplier::findOrFail($id);
        $records = $supplier->products()->get();
        foreach ($records as $record) {
            $record->update([
                'discountValueStatus' => 0,
                'discountPercentStatus' => 1
            ]);
        }
        session()->flash('success', 'تم تفعيل نسب الخصم  بنجاح');
        Log::createLog($record, auth()->user(), 'عملية تفعيل', ' تفعيل نسب الخصم للمورد  #' . $supplier->id);
        return redirect()->back();
    }
    public function activateAllProducts($id)
    {

        $supplier = Supplier::findOrFail($id);
        $records = $supplier->products()->get();
        foreach ($records as $record) {
            $record->update([
                'is_active' => 1,
            ]);
        }
        session()->flash('success', 'تم تفعيل منتجات الممورد  بنجاح');
        Log::createLog($record, auth()->user(), 'عملية تفعيل', ' تفعيل جميع منتجات للمورد  #' . $supplier->id);
        return redirect()->back();
    }


    public function dactivateAllProducts($id)
    {
        $supplier = Supplier::findOrFail($id);
        $records = $supplier->products()->get();
        foreach ($records as $record) {
            $record->update([
                'is_active' => 0,
            ]);
        }
        session()->flash('success', 'تم الغاء تفعيل منتجات المورد  بنجاح');
        Log::createLog($record, auth()->user(), 'عملية الغاء تفعيل', ' الغاء تفعيل جميع منتجات للمورد  #' . $supplier->id);
        return redirect()->back();
    }
      public function toggleBoolean($id, $action)
    {
        $record = $this->model->findOrFail($id);
        Helper::toggleBoolean($record, $action);
        if ($record->$action == 1) {
            Log::createLog($record, auth()->user(), 'عملية تفعيل', 'تفعيل  منتج #' . $record->id);
        } else {
            Log::createLog($record, auth()->user(), 'عملية الغاء تفعيل ', 'الغاء تفعيل  منتج #' . $record->id);
        }

        return Helper::responseJson(1, 'تمت العملية بنجاح');
    }
}
