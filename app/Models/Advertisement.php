<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{

    use GetAttribute;

    protected $table = 'advertisements';
    public $timestamps = true;
    protected $fillable = array('name', 'is_active','link','type');




    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }

    public function getTypePostionAttribute(){

        $typeArray=[
            '0' => 'لوحة الاعلانات',
            '1' => ' الاعلانات الصغيرة اسفل لوحة الاعلانات',
            '2' => 'الفئات',
            '3 ' => 'اسفل الصفحة',
         ];
        return $typeArray[$this->attributes['type']];
    }
}
