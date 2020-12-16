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

    protected $education = [
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
        ],

    ];

    public function getGender(){
        return array_get($this->gender,$this->Gender,'[N\A]');
    }

    public function getEducation(){
        return array_get($this->education,$this->Education,'[N\A]');
    }
}
