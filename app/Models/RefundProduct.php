<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundProduct extends Model
{
    use LogTrait;

    protected $table = 'refunds_products';
    public $timestamps = true;
    protected $fillable = array('product_id', 'refund_id','quantity','price','supplier_id');

    public function refund()
    {
        return $this->belongsTo('App\Models\Refund');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product');

    }

}
