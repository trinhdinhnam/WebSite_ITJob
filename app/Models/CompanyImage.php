<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyImage extends Model
{
    //
    protected $table = 'company_images';
    protected $primaryKey = 'CompanyImageId';
    protected $guarded=[''];

    public function recruiter(){
        return $this->belongsTo( Recruiter::class,'RecruiterId');
    }
}
