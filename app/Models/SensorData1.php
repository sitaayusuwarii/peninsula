<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData1 extends Model
{
    public $timestamps = false;
    protected $table = 'sensor_data1';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
