<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function child(Request $request)
    {
        $data = Category::where('parent_id', $request->child_id)->get(["name", "id"]);
        return response()->json($data);
    }
    
}
