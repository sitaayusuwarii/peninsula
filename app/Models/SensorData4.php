<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData4 extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sensor_data4';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
