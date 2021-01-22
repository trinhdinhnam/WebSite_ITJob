<?php

namespace App\Models;
use App\Models\RecruiterLevel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\Conversion\Conversion;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Recruiter extends Authenticatable
{
    //
    protected $table = 'recruiters';
    protected $primaryKey = 'id';
    protected $guarded=[''];

    public function review(){
        return $this->hasMany(Review::class,'RecruiterId');
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
