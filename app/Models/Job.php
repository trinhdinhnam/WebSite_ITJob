<?php

namespace App\Models;
use App\Models\Language;
use App\Models\Recruiter;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
    public function position(){
        return $this->belongsTo(Position::class,'PositionId');
    }
    public function recruiter(){
        return $this->belongsTo(Recruiter::class,'RecruiterId');
    }
    public function seekerJob(){
            return $this->hasMany(SeekerJob::class,'JobId');
    }
    public function formatDate($date){
        Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
        return Carbon::parse($date)->diffForHumans(Carbon::now());
    }
}