<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Supplier extends Authenticatable
{
    use LogTrait;

    public $guard_name = 'supplier';
    protected $table = 'suppliers';
    public $timestamps = true;
    protected $fillable = array('name', 'password', 'email', 'phone', 'adminProfit', 'allProfit', 'availableProfit', 'withdraw', 'refundProfit','allRefundProfit','code');
    protected $hidden = array('password');

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function refunds()
    {
        return $this->hasMany('App\Models\Refund');
    }
    public function getNetProfitAttribute(){
        return $this->availableProfit - ($this->refundProfit + $this->getWebsiteProfitAttribute()) ;
    }
    public function getWebsiteProfitAttribute(){

        return $this->availableProfit * ($this->adminProfit / 100);

    }
    public function getAllWebsiteProfitAttribute(){

        return $this->allProfit * ($this->adminProfit / 100);

    }
    public function getAllSupplierNetProfitAttribute(){

        return $this->allProfit - ($this->allRefundProfit + $this->getAllWebsiteProfitAttribute()) ;
    }

}
