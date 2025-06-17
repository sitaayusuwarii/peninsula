<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData2 extends Model
{
    public $timestamps = false;
    protected $table = 'sensor_data2';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
