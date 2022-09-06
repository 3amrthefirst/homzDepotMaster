<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use LogTrait;

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('customer_id', 'government_id','totalPrice','total_after_discount','address','status', 'shipping','code', 'phone', 'name', 'phone2' ,'type','source','captured_amount','discount_code_id');

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function government()
    {
        return $this->belongsTo('App\Models\Goverment');
    }

    public function products()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }
    public function discountCode()
    {
        return $this->belongsTo('App\Models\DiscountCode','discount_code_id');
    }
    public function getOrderStatusAttribute()
    {
        $statusArray=[
            'pending'=>'قيد التنفيذ',
            'storePending'=>'قيد التنفيذ',
            'inProgress'=>'قيد التنفيذ',
            'ready'=>' جاهز للشحن',
            'delivered'=>'تم الشحن',
            'received'=>'تم التسليم',
            'canceled'=>' ملغي',
            'rejected'=>' مرفوض',
            'notRecevied'=>' تم رفض الاستلام',
        ];
        return $statusArray[$this->attributes['status']];
    }

    public function refunds(){
        return $this->hasMany('App\Models\Refund');
    }

}
