<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData7 extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sensor_data7';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
