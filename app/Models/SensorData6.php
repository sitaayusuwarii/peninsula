<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData6 extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sensor_data6';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
