<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Category
{
    protected $fillable = array('name', 'parent_id');

    //
    public function category()
    {
        return $this->belongsTo('App\Models\Category','parent_id','id');
    }





}
