<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{

    use LogTrait;
    protected $table = 'refunds';
    public $timestamps = true;
    protected $fillable = array( 'order_id','type', 'supplierName', 'address','customerName', 'phone','date');

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Models\RefundProduct');
    }


}
