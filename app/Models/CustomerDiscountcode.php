<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDiscountcode extends Model
{
    protected $table = 'customer_discountcodes';
    public $timestamps = true;
    protected $fillable = array('customer_id', 'duscountCode_id');}
