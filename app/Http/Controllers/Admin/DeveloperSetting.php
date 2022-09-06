<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
//use App\my_helper\Helper;
use App\MyHelper\Helper;
use App\MyHelper\Photo;
use Illuminate\Http\Request;
use Response;

class DeveloperSetting extends Controller
{
    protected $model;
    protected $viewsDomain = 'admin.developer_setting.';

    public function __construct()
    {
        $this->model = new Setting();
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
    public function index()
    {
        $records = Setting::latest()->paginate(20);
        return $this->view('index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = $this->model;
        $validation = null;
        return $this->view('create', compact('model', 'validation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =
            [
                'settings_category_id'  => 'required|exists:settings_categories,id',
                'display_name'           => 'required',
                'key'           => 'required',
                'value'           => 'required',
                'data_type'           => 'required',
                'validation'           => 'required',
                'level'           => 'required',
            ];


        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = $this->model->create($request->all());


        $record->validation()->create(['value' => $request->validation]);


        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect('admin/developer/setting');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);
        $validation = $model->validation ? $model->validation->value : null;

        return $this->view('edit', compact('model', 'validation'));
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
        $rules =
            [
                'settings_category_id'  => 'required|exists:settings_categories,id',
                'display_name'           => 'required',
                'key'           => 'required',
                'value'           => 'required',
                'data_type'           => 'required',
                'validation'           => 'required',
                'level'           => 'required',
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = $this->model->findOrFail($id);

        $record->update($request->all());

        if ($record->validation()->count()) {
            $record->validation()->update(['value' => $request->validation]);
        } else {
            $record->validation()->create(['value' => $request->validation]);
        }


        session()->flash('success', 'تمت تحديث بنجاح');
        return redirect('manager/developer/setting/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);

        if ($record->data_type == 'mulifileWithPreview' && $record->photos()->count()) {
            Photo::deletePhoto($record, 'photos', 'normal', true);
        } elseif ($record->data_type == 'fileWithPreview' && $record->photo) {
            Photo::deletePhoto($record);
        }

        $record->validation()->delete();

        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        return Response::json($data, 200);
    }
}
