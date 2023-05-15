<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackedData extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'latitude',
        'longitude',
        'device',
        'ip',
        'city',
        'region',
        'country',
        'username',
        'password',
    ];

}
