<?php

namespace App\Models\Calendars;

use Illuminate\Database\Eloquent\Model;

class ReserveSettings extends Model
{
    const UPDATED_AT = null;
    public $timestamps = false;

    protected $fillable = [
        'setting_reserve',
        'setting_part',
        'limit_users',
    ];

    //userテーブルとリレーション
    public function users(){
        return $this->belongsToMany('App\Models\Users\User', 'reserve_setting_users', 'reserve_setting_id', 'user_id')->withPivot('reserve_setting_id', 'id');
    }

    //各予約パートのユーザー数のカウント
    // public function reserveSettingCounts($date, $part){
    //     return $this->where('setting_reserve', $date)->where('setting_part', $part)->get()->count();
    // }
}
