<?php

namespace App\Models\Calendars;

use Illuminate\Database\Eloquent\Model;

class Calendars extends Model
{
    const UPDATED_AT = null;
    public $timestamps = false;

    protected $fillable = [
        'reserve_date',
        'reserve_part',
    ];

    //userテーブルとリレーション
    public function users(){
        return $this->belongsToMany('App\Models\Users\User', 'user_id', 'calendar_id', 'user_id')->withPivot('calendar_id', 'id');
    }
}
