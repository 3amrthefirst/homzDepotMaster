<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
class CustomerController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $records = Customer::where(function($q) use ($request){
        if ($request->phone){
            $q->where('phone','LIKE','%'.$request->phone.'%');
        }
        if ($request->name){
            $q->where('fname','LIKE','%'.$request->name.'%');
        }
    })->paginate(25);
    return view('admin.customers.index', compact('records'));
    
  }

 public function customerOrders($id){

    $customer = Customer::findOrFail($id);
    $records = $customer->orders()->paginate(25);
    return view('admin.customers.orders', compact('records'));

 }
  
}

?>