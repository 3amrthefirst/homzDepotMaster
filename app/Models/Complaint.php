<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use LogTrait;
    protected $table = 'complaints';
    public $timestamps = true;
    protected $fillable = array('customer_id', 'message', 'type','phone');

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

}
