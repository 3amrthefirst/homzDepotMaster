<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\my_helper\Helper;
use App\MyHelper\Photo;

use App\MyHelper\SettingField;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    public function view()
    {

        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $settings = Setting::all();

        $data = validator()->make($request->all(), SettingField::validation($settings));

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        foreach ($settings as $setting) {
            if ($setting->data_type == 'fileWithPreview') {
                if ($request->hasFile($setting->key)) {
                    if ($setting->photo) {
                        Photo::updatePhoto($request->file($setting->key) , $setting->photo, $setting, 'settings');
                    } else {
                        $image = $request->file($setting->key);
                        Photo::addPhoto($image, $setting, 'settings');
                    }
                }

            } elseif ($setting->data_type == 'mulifileWithPreview') {
                if ($request->hasFile($setting->key)) {
                    foreach ($request->file($setting->key) as $photo) {
                        Photo::addPhoto($photo, $setting, 'settings', 'photos');
                    }
                }
            } else {
                $setting->update(
                    [
                        'value' => $request[$setting->key],
                    ]);

            }
        }

        session()->flash('success', 'تمت التعديل بنجاح');
        return redirect('admin/settings');
    }

}
