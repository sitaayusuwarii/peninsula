<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData8 extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sensor_data8';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
