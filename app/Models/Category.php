<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use LogTrait ;


    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('parent_id', 'name', 'price','icon');

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }


    public function subCategories()
    {
        return $this->hasMany('App\Models\Category','parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeSub($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
