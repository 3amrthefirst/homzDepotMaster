<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use File;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function destroy($id)
    {
        $photo = Attachment::findOrFail($id);
        File::delete(public_path() . '/' . $photo->path);
        $photo->delete();
        $data = ['status' => 1, 'msg' => __('تم الحذف بنجاح'), 'id' => $photo->id];
        return response()->json($data, 200);
    }

}
