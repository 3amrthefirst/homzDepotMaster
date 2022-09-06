<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use GetAttribute,LogTrait;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'price', 'code', 'color', 'description',
     'supplier_id', 'original_quantity', 'availableQuantity', 'saledQuantity','refundQuantity',
      'status', 'is_active', 'receivedTime', 'colorName', 'discountValue', 'discountPercent',
       'discountValueStatus', 'discountPercentStatus','category_id','subCategory_id',
       'size','material'

    );
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }


    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function addQ()
    {
        return $this->hasMany('App\Models\AddQuantity');
    }

    public function pullQ()
    {
        return $this->hasMany('App\Models\PullQuantity');
    }

    public function reason()
    {
        return $this->hasOne('App\Models\Reason','product_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');

    }
    public function subCategory(){
        return $this->belongsTo('App\Models\Category','subCategory_id',);

    }
    public function orderProducts(){

        return $this->hasMany('App\Models\OrderProduct');

    }
    public function refundProducts(){

        return $this->hasMany('App\Models\refundProduct');

    }
    public function getProductStatusAttribute()
    {
        if ($this->status == 'accepted') {
            return 'مقبوله' ;
        } elseif ($this->status == 'pending') {
            return 'معلقه' ;
        } else {
            return 'مرفوضه' ;
        }
    }
    public function getProductReceivedTimeAttribute()
    {
        if ($this->receivedTime == 'oneWeek') {
            return '7 أيام عمل' ;
        } elseif ($this->receivedTime == 'twoWeek') {
            return '10 أيام عمل' ;
        } else {
            return 'بالطلب' ;
        }
    }
  

    public function getProdcutsPriceAfterDiscountPercentsAttribute(){
        $tax = ($this->discountPercent/100) * $this->price;
        $categoryPrice = $this->subCategory->price;
        return ($this->price - $tax) + $categoryPrice;
    }

    public function getProductPriceAfterDiscountValueAttribute(){
        $categoryPrice = $this->subCategory->price;
        return $this->discountValue + $categoryPrice;
    }

    public function getProductPriceAttribute(){
        $categoryPrice = $this->subCategory ->price;
        return $this->price + $categoryPrice;
    }


}
