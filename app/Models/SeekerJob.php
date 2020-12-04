<?php

namespace App\Models;
use App\Models\Job;
use App\Models\Seeker;

use Illuminate\Database\Eloquent\Model;

class SeekerJob extends Model
{
    //
    protected $table = 'seeker_jobs';
    protected $primaryKey = 'SeekerJobId';
    protected $guarded=[''];

    public function job(){
        return $this->belongsTo(Job::class,'JobId');
    }
    public function seeker(){
        return $this->belongsTo(Seeker::class,'SeekerId');
    }

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
}
