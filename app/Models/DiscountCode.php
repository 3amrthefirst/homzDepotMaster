<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{

    use LogTrait;
    protected $table = 'discountCodes';
    public $timestamps = true;
    protected $fillable = array('code', 'is_active', 'value', 'total_price','status', 'maxUser','max_value');

    public function getCodeStatusAttribute()
    {
        if ($this->status == 'percent') {
            return 'نسبه' ;
        } else{
            return 'قيمه' ;
        }
    }
    public function customers(){
        return $this->hasMany('App\Models\CustomerDiscountcode','duscountCode_id');
    }

}
