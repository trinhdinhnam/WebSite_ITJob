<?php

namespace App\Models;
use App\Models\Job;
use App\Models\Seeker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        0 => [
            'name' => 'Đang chờ',
            'class' => 'badge-danger'
        ],
        1 => [
            'name' => 'Đã duyệt',
            'class' => 'badge-success'
        ],
        null => [
            'name' => ''
        ]
    ];
    public function getStatus(){
        return array_get($this->status,$this->Status,'[N\A]');
    }

    public function formatDate($date){
        Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
        return Carbon::parse($date)->diffForHumans(Carbon::now());
    }
}
