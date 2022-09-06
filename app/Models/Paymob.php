<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymob extends Model
{
    //
        protected $table = 'paymobs';
    public $timestamps = true;
    protected $fillable = array('status', 'order', 'amount_cent', 'success', 'error_occured','is_refunded','customer_id','order_id','created_at','updated_at');
    
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
}
