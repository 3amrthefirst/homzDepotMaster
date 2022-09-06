<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    use LogTrait;

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('supplier_id', 'amount','refund','websiteProfit', 'allAmount');

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    
    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

}
