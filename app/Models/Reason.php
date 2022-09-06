<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{

    protected $table = 'reasons';
    public $timestamps = true;
    protected $fillable = array('message', 'product_id', 'add_quantity_id', 'pull_quantity_id');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function addQ()
    {
        return $this->belongsTo('App\Models\AddQuantity','add_quantity_id');
    }

    public function pullQ()
    {
        return $this->belongsTo('App\Models\PullQuantity','pull_quantity_id');
    }

}
