<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData5 extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sensor_data5';

    protected $fillable = [
        'location',
        'distance',
        'status',
        'timestamp',
    ];
}
