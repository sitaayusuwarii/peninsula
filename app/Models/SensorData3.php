<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData3 extends Model
{
    public $timestamps = false;
    protected $table = 'sensor_data3';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
