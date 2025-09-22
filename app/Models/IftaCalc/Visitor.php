<?php

namespace App\Models\IftaCalc;

use Illuminate\Database\Eloquent\Model;
use App\Models\IftaCalc\Visit as Visit;

class Visitor extends Model
{
    //
    protected $connection = 'mysql_iftacalc';
    protected $fillable = [
        'visitor_id', 
        'ui_verified',
        'is_mobile',
        'gclientid',
        'fbp',
        'user_id',
        'meta'

    ];


    protected $casts = [
        'meta'=>'array'
    ];

    public function visits(){

        return $this->hasMany(Visit::class);
    }

}
