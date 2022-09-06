<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends  Authenticatable 
{

    protected $table = 'customers';
    public $timestamps = true;
    protected $fillable = array('fname','lname', 'email', 'password','phone', 'address');

    public function complaints()
    {
        return $this->hasMany('App\Models\Complaint');
    }
    public function orders(){
        return $this->hasMany('App\Models\Order');

    }

}