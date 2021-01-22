<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seeker extends Authenticatable implements HasMedia
{
    //
    use HasMediaTrait;
    protected $table = 'seekers';
    protected $primaryKey = 'id';
    protected $guarded=[''];

    protected $fillable = [
        'SeekerName', 'email', 'password','provider','provider_id'
    ];

    protected $gender = [
        0 => [
            'name' => 'Nữ',
        ],
        1 => [
            'name' => 'Nam',
        ],
        2 => [
            'name' => 'Giới tính khác'
        ],
        null => [
            'name' => ''
        ]
    ];

    public function getGender(){
        return array_get($this->gender,$this->Gender,'[N\A]');
    }

    protected $education = [
        0 => [
            'name' => ''
        ],
        1 => [
            'name' => 'Tiến sĩ',
        ],
        2 => [
            'name' => 'Thạc sĩ',
        ],
        3 => [
            'name' => 'Đại học'
        ],
        4 => [
            'name' => 'Cao đẳng'
        ],
        5 => [
            'name' => 'Tốt nghiệp phổ thông'
        ]

    ];


    public function getEducation(){
        return array_get($this->education,$this->Education,'[N\A]');
    }

    public function seekerJob(){
        return $this->hasMany(SeekerJob::class,'id','SeekerId');
    }
}
