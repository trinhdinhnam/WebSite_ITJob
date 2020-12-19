<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $table = 'positions';
    protected $primaryKey = 'PositionId';
    protected $guarded=[''];

    protected $fillable = ['PositionId', 'PositionName'];
}
