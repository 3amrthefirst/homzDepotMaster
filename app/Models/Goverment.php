<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goverment extends Model
{
    use LogTrait;

    protected $table = 'governments';
    public $timestamps = true;
    protected $fillable = array('id','name', 'price','time');

    public function order()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}
