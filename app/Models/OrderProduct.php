<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    protected $table = 'orders_products';
    public $timestamps = true;
    protected $fillable = array('Order_id','product_id', 'quantity', 'price');

    public function order()
    {
        return $this->belongsTo('App\Models\Order' ,'Order_id');
    }
    public function product(){

        return $this->belongsTo('App\Models\Product');

    }

}
