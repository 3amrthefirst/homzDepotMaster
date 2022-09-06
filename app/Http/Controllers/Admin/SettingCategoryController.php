<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SettingsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingCategoryController extends Controller
{
    protected $model;
    protected $viewsDomain = 'admin/developer_setting/categories.';

    public function __construct()
    {
        $this->model = new SettingsCategory();
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $records = $this->model->where(function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', $request->name);
            }

        })->paginate(10);

        return $this->view('index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $record = $this->model;
        return $this->view('create', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'name'        => 'required',
            'level' => 'required',
        ];

        $this->validate($request, $rules);
        $record = $this->model->create($request->all());

        session()->flash('success', 'تم الإضافة');
        return redirect('admin/developer/settings/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        return $this->view('edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'        => 'required',
            'level' => 'required',
        ];

        $this->validate($request, $rules);

        $record = $this->model->findOrFail($id);
        $record->update($request->all());

        session()->flash('success', 'تم التعديل');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return response()->json([
                                        'status'  => 0,
                                        'message' => 'تعذر الحصول على البيانات'
                                    ]);
        }

        if ($record->settings()->count()) {
            return response()->json([
                                        'status'  => 0,
                                        'message' => 'توجد اعدادات مرتبطة بهذا القسم',
                                    ]);
        }

        $record->delete();
        return response()->json([
                                    'status'  => 1,
                                    'message' => 'تم الحذف بنجاح',
                                    'id'      => $id
                                ]);
    }
}
