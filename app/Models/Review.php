<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'reviews';
    protected $primaryKey = 'ReviewId';
    protected $guarded=[''];

    public function recruiter(){
        return $this->belongsTo(Recruiter::class,'RecruiterId');
    }
    public function seeker(){
        return $this->belongsTo(Seeker::class,'SeekerId');
    }
}
