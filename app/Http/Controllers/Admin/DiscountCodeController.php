<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Models\Log;
use App\MyHelper\Helper;
use Response;

class DiscountCodeController extends Controller
{
  protected $model ;
    protected $viewsDomain = 'admin/discount-code.';
    protected $url = 'admin/discount-code';
    public function __construct()
    {
        $this->model = new DiscountCode();
    }
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $records = $this->model->where(function ($q) use ($request) {
        if ($request->code) {
            $q->where(function ($q) use ($request) {
                $q->where('code', 'LIKE', '%' . $request->code . '%');
            });
        }

    })->paginate();
    return $this->view('index',compact('records'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $model = $this->model;
    return $this->view('create', compact('model'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $rules =
    [
        'code' => 'required|unique:discountCodes',
        'maxUser' => 'required',
        'status'=>'required',
        'max_value'=>'numeric|nullable',
        'total_price'=>'numeric|nullable'    ];

    $error_sms =
        [
            'code.required' => 'الرجاء ادخال الكود ',
            'code.unique' => 'هذا الكود موجود من قبل',
            'maxUser.required' => 'الرجاء ادخال عدد المستخدمين ',
            'status.required' => 'الرجاء ادخال نوع الكود ',

        ];

    $data = validator()->make($request->all(), $rules, $error_sms);

    if ($data->fails()) {
        return back()->withInput()->withErrors($data->errors());
    }
     if($request->status=="percent" && !$request->max_value )
    {
        session()->flash('error', ' يجب تحديد اكبر قيمه للخصم');
        return redirect()->back();


    }else{

    $record = $this->model->create($request->all());
    Log::createLog($record, auth()->user(), 'عملية اضافة', ' اضافة كود خصم #' . $record->id);
    session()->flash('success', 'تمت الاضافة بنجاح');
    return redirect($this->url);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $model = $this->model->findOrFail($id);
    return $this->view('edit', compact('model'));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
      //check if new code is exist or not "DON'T FORGET YA KHALODA"

    $rules =
    [
        'code' => 'required',
        'maxUser' => 'required',
        'maxUser' => 'required',
        'max_value'=>'numeric|nullable',
        'total_price'=>'numeric|nullable'
    ];

    $error_sms =
        [
            'code.required' => 'الرجاء ادخال الكود ',
            'code.unique' => 'هذا الكود موجود من قبل',
            'maxUser.required' => 'الرجاء ادخال عدد المستخدمين ',
        ];

    $data = validator()->make($request->all(), $rules, $error_sms);

    if ($data->fails()) {
        return back()->withInput()->withErrors($data->errors());
    }
     if($request->status=="percent" && !$request->max_value )
    {
        session()->flash('error', ' يجب تحديد اكبر قيمه للخصم');
        return redirect()->back();


    }else{

    $record = $this->model->findOrFail($id);
    $record->update($request->all());
    Log::createLog($record, auth()->user(), 'عملية تعديل', 'تعديل كود خصم #' . $record->id);
    session()->flash('success', 'تمت تحديث بنجاح');
    return redirect($this->url);
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

    $data = [
        'status' => 1,
        'message' => 'تم الحذف بنجاح',
        'id' => $id
    ];
    Log::createLog($record, auth()->user(), 'عملية حذف', 'حذف كود خصم #' . $record->code);
    return Response::json($data, 200);

  }

  //for activcate code on website 'make it available to use'
public function toggleBoolean($id, $action)
{
    $record = $this->model->findOrFail($id);
    Helper::toggleBoolean($record, $action);
    if ($record->$action == 1) {
        Log::createLog($record, auth()->user(), 'عملية تفعيل', 'تفعيل  كود خصم #'.$record->id);
    } else {
        Log::createLog($record, auth()->user(), 'عملية الغاء تفعيل ', 'الغاء تفعيل  كود خصم #'.$record->id);
    }

    return Helper::responseJson(1, 'تمت العملية بنجاح');
}
}

?>
