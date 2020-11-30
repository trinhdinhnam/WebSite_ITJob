<?php

namespace App\Models;
use App\Models\Job;
use App\Models\Seeker;

use Illuminate\Database\Eloquent\Model;

class SeekerJob extends Model
{
    //
    protected $table = 'seeker_jobs';
    protected $guarded=[''];

    public function job(){
        return $this->belongsTo(Job::class,'JobId');
    }
    public function seeker(){
        return $this->belongsTo(Seeker::class,'SeekerId');
    }
}
