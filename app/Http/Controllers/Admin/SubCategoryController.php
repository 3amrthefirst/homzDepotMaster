<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Log;
use Response;

class SubCategoryController extends Controller
{
    protected $model ;
    protected $viewsDomain = 'admin/sub_categories.';
    protected $url = 'admin/sub-categories';
    public function __construct()
    {
        $this->model = new SubCategory();
    }
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat_id)
    {
        //
        $records = Category::find($cat_id);

        return $this->view('index', compact('records', 'cat_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        //
        $model = $this->model;
        $edit = false ;
        return $this->view('create', compact('model', 'category', 'edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Request $request)
    {
        //
        $rules =
            [
                'name' => 'required',
                'price' => 'required',
               
            ];

        $error_sms =
            [
                'name.required' => 'الرجاء ادخال الاسم ',
                'price.requierd'=>'الرجاء ادخال السعر'
            ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $record =$category->subCategories()->create($request->all());
        Log::createLog($record, auth()->user(), 'عملية اضافة', ' اضافة اهتمام فرعي #' . $category->id);
        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect(route('categories.sub-categories.index', $category->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        //
        $model = $this->model->findOrFail($id);

        $edit = true ;
        return $this->view('edit', compact('model', 'category', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id)
    {


        //
        $rules =
            [
                'name' => 'required',
                'price' => 'required',

            ];

        $error_sms =
            [
                'name.required' => 'الرجاء ادخال الاسم ',
                'price.requierd'=>'الرجاء ادخال السعر'

            ];



        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = $this->model->findOrFail($id);

        $record->update($request->all());

        Log::createLog($record, auth()->user(), 'عملية تعديل', ' تعديل اهتمام فرعي #' . $record->id);

        session()->flash('success', 'تمت تحديث بنجاح');
        return redirect(route('categories.sub-categories.index', $category->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        $record = $this->model->findOrFail($id);

        $record->delete();

        $data = [
            'status' => 1,
            'message' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        Log::createLog($record, auth()->user(), 'عملية حذف', ' حذف اهتمام فرعي #' . $record->name);

        return Response::json($data, 200);
    }
}
