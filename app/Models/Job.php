<?php

namespace App\Models;
use App\Models\Language;
use App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $table = 'jobs';
    protected $primaryKey = 'JobId';
    protected $guarded=[''];

    protected $status = [
        1 => [
            'name' => 'Đã duyệt',
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

    public function language(){
        return $this->belongsTo(Language::class,'LanguageId');
    }
    public function company(){
        return $this->belongsTo(Company::class,'CompanyId');
    }
}