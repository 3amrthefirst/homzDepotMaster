<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Charts\OrderPieChart;
use App\Models\Product;
use App\Charts\LineChart;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function index(Request $request)
    {
        $pie = $this->buildPieChart();
        $line1 = $this->productPerMonth($request);
        $orders = Order::where('status', 'canceled')->get();
        return view('admin.layouts.home',compact('pie','line1','orders'));
    }
    protected function buildPieChart()
    {
//        $auth_groups = auth()->user()->groups->count();
        $up = Order::where('status','pending')->count();
        $down = Order::where('status','storePending')->get()->count();
        $under = Order::where('status','inProgress')->get()->count();
        $ready = Order::where('status','ready')->get()->count();
        $delv = Order::where('status','delivered')->get()->count();
        $received = Order::where('status','received')->get()->count();
        $notReceived = Order::where('status','notReceived')->get()->count();
        $canceld = Order::where('status','canceled')->get()->count();
        $rejected =  Order::where('status','rejected')->get()->count();
        $orderPieChart = new OrderPieChart;
        $orderPieChart
            ->labels([__('الطلبات المعلقه')
                , __('في انتظار موافقه المخزن')
                , __('يتم تجهيزها من المخزن'),
                'يتم تجهيزها للشحن',
                'تم شحنها',
                'تم استلامها',
                'رفضت الاستلام',
                'ملغيه',
                'مرفوضه',
            ])
            ->dataset('الطلبات' , 'pie',
                [$up, $down, $under,$ready,$delv,$received,$notReceived,$canceld,$rejected])
            ->backgroundcolor([
                "#C7E8F3",
                "#BF9ACA",
                "#8E4162",
                "#DA4167",
                "#41393E",
                "#EDA2C0",
                "#EDA2f7",
                "#8E4342",
            ]);

        return $orderPieChart;
    }
    private function productPerMonth($request)
    {
        $product = Product::where(function ($query) use($request){

        })->selectRaw('count(id) as total_products,DATE_FORMAT(created_at,"%Y-%m") as month')
            ->groupBy('month')->orderBy('month','asc')->get();




        $productsMonthly = new LineChart;
        $productsMonthly
            ->labels($product->pluck('month')->toArray())
            ->dataset('عدد المنتجات شهريا','line',$product->pluck('total_products')->toArray())
            ->color("rgb(54, 162, 235)")->backgroundColor("rgb(54, 162, 235)")->fill(false);

        return $productsMonthly;
    }


}
