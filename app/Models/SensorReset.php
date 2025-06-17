<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorReset extends Model
{
    protected $fillable = ['sensor_name', 'reset_at'];
}
