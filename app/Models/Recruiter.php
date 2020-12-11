<?php

namespace App\Models;
use App\Models\RecruiterLevel;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    //
    protected $table = 'recruiters';
    protected $primaryKey = 'id';
    protected $guarded=[''];

    public function recruiterLevel(){
        return $this->belongsTo(RecruiterLevel::class,'RecruiterLevelId');
    }

    protected $active = [
        1 => [
            'name' => 'Đang hoạt động',
            'class' => 'badge-success'
        ],
        0 => [
            'name' => 'Dừng hoạt động',
            'class' => 'badge-danger'
        ]
        ];
        protected $gender = [
            1 => [
                'name' => 'Nam',
            ],
            0 => [
                'name' => 'Nữ',
            ],
            2 => [
                'name' => 'Giới tính khác'
            ]
        ];
    public function getActive(){
        return array_get($this->active,$this->Active,'[N\A]');
    }
    public function getGender(){
        return array_get($this->gender,$this->Gender,'[N\A]');
    }

}
