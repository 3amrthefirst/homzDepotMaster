<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goverment;
use App\Models\Log;

class GovermentController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $records = Goverment::where(function ($query) use ($request) {
      if ($request->name) {
          $query->where('name', 'LIKE', '%' . $request->name . '%');
          if ($request->price) {
              $query->where('price', 'LIKE', '%' . $request->price . '%');
          }
      }
     })->latest()->paginate(50);
    return view('admin.goverments.index', compact('records'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $model = Goverment::all();
    return view('admin.goverments.create',compact('model'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $rules = [
      'name' => 'required',
      'price' => 'required',
      'time' => 'required'
  ];
  $messages = [
      'name.required' => 'الاسم مطلوب',
      'price.required' => 'السعر مطلوب',
      'time.required' => 'مدة التوصيل مطلوبة',

  ];

  $this->validate($request, $rules, $messages);

  $record = Goverment::create($request->all());
  session()->flash('success', 'تمت الإضافة بنجاح');

  Log::createLog($record , auth()->user() ,'عملية انشاء' ,'انشاء محافظة ');
  return redirect(route('goverments.index'));
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
    $model = Goverment::findOrFail($id);

        return view('admin.goverments.edit', compact('model'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id,Request $request)
  {
        $rules = [
          'name' => 'required',
          'price' => 'required',
          'time' => 'required',
      ];
      $messages = [
          'name.required' => 'الاسم مطلوب',
          'price.required' => 'السعر مطلوب',
          'time.required' => 'مدة التوصيل مطلوبة',
      ];
      $this->validate($request, $rules, $messages);
      $record = Goverment::findOrFail($id);
      $record->update($request->all());
      session()->flash('success', 'تم التعديل بنجاح');
      Log::createLog($record , auth()->user() ,'عملية تعديل' ,'تعديل محافظة ');

      return redirect(route('goverments.index'));

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $record = Goverment::findOrFail($id);
    $record->delete();
    Log::createLog($record , auth()->user() ,'عملية حذف' ,'حذف محافظة ');

    return response()->json([
        'status' => 1,
        'message' => 'تم الحذف بنجاح',
        'id' => $id,
    ]);
  }

}

?>
