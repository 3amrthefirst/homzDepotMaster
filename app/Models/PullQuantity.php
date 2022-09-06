<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PullQuantity extends Model
{
    use LogTrait;

    protected $table = 'pullQuantities';
    public $timestamps = true;
    protected $fillable = array('product_id', 'quantity', 'status','admin_id','supplier_id');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
    public function reason()
    {
        return $this->hasOne('App\Models\Reason');
    }
    public function getPullQuantityStatusAttribute()
    {
        if ($this->status == 'accepted') {
            return 'مقبوله' ;
        } elseif ($this->status == 'pending') {
            return 'معلقه' ;
        } else {
            return 'مرفوضه' ;
        }
    }


}
