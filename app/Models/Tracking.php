<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'url',
        'short_url',
    ];

    public function data()
    {
        return $this->hasMany(TrackedData::class);
    }

}
