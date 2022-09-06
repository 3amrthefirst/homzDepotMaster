<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Order::where(function ($query) use ($request) {
            if ($request->toDate && $request->fromDate) {
                $query->whereBetween('created_at', [$request->fromDate, $request->toDate]);
            } elseif ($request->fromDate) {
                $query->whereDate('created_at', $request->fromDate);
            } elseif ($request->toDate) {
                $query->whereDate('created_at', $request->toDate);
            }

        })
        ->whereHas('customer',function($q) use ($request){
            if ($request->name){
                $q->where('fname','LIKE','%'.$request->name.'%');
            }
            elseif ($request->lname){
                $q->where('lname','LIKE','%'.$request->lname.'%');
            }

        })

        ->where('status','received')
        ->latest()
        ->get();

        $categories_price = 0;

        foreach ($records as $record){
            $products=$record->products()->get();
            foreach ($products as $product){
                $categories_price += $product->product->subCategory->price;
            }
        }


        $orders = Order::where(function ($query) use ($request) {
            if ($request->toDate && $request->fromDate) {
                $query->whereBetween('created_at', [$request->fromDate, $request->toDate]);
            } elseif ($request->fromDate) {
                $query->whereDate('created_at', $request->fromDate);
            } elseif ($request->toDate) {
                $query->whereDate('created_at', $request->toDate);
            }
        })
        ->whereHas('customer',function($q) use ($request){
            if ($request->name){
                $q->where('fname','LIKE','%'.$request->name.'%');
            }
            elseif ($request->lname){
                $q->where('lname','LIKE','%'.$request->lname.'%');
            }
        })
        ->latest()
        ->get();

        return view('admin.reports.index', compact('records','orders','categories_price'));

    }

    public function orderRefund($id){
        $order = Order::findOrFail($id);
       $records = $order->refunds()
       ->paginate();

       return view('admin.reports.refund', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
