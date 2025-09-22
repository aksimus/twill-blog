<?php

namespace App\Models\IftaCalc;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    //
    protected $connection = 'mysql_iftacalc';
    public $incrementing = false; // disable auto-increment
    protected $keyType = 'string'; // primary key is string

    protected $fillable = [
        'id',
        'visitor_id',
        'meta'
    ];
    protected $casts = [
        'meta'=>'array'
    ]; 
}
