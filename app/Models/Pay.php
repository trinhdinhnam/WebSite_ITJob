<?php

namespace App\Models;
use App\Models\Recruiter;
use App\Models\AccountPackage;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    //
    protected $table = 'pays';
    protected $primaryKey = 'PayId';
    protected $guarded=[''];

    protected $status = [
        1 => [
            'name' => 'Xác nhận',
            'class' => 'badge-success'
        ],
        0 => [
            'name' => 'Đang chờ',
            'class' => 'badge-danger'
        ]
        ];
    public function getStatus(){
       return array_get($this->status,$this->Status,'[N\A]');
    }
    
    public function recruiter(){
        return $this->belongsTo(Recruiter::class,'RecruiterId');
    }
    public function accountPackage(){
        return $this->belongsTo(AccountPackage::class,'AccountPackageId');
    }
}