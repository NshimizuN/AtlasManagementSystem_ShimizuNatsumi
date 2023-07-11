<?php
namespace App\Calendars\Admin;
use Carbon\Carbon;
use App\Models\Calendars\ReserveSettings;

//スクール予約確認
class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  function render(){
    return '<p class="day">' . $this->carbon->format("j") . '日</p>';
  }

  function everyDay(){
    return $this->carbon->format("Y-m-d");
  }

  //予約人数をカウント
  function dayPartCounts($ymd){
    $html = [];
    //１部
    $one_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    //2部
    $two_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
    //３部
    $three_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();

    //各部の人数、リンクの表示
    $html[] = '<div class="text-left">';
    //１部
    if($one_part){
      $one_count = $one_part->users->count();
      //$one_countに$one_partのユーザーをカウントした数を代入
      $one_url = route('calendar.admin.detail', ['reservePersons' => $one_part ,'date' => $ymd, 'part' => '1']);
      //$one_urlにルートの名前、渡したいデータのパラメータを代入。
      //$one_part=該当予約のユーザーデータ
      $html[] = '<a href="' . $one_url . '">';
      $html[] = '<span class="day_part m-0 pt-1">1部 </span>';
      $html[] = '</a>';
      $html[] = '&emsp;';
      $html[] = '<span class="day_part_count m-0 pt-1">'.$one_count.'</span>';
      $html[] = '<br>';
    }
    //2部
    if($two_part){
      $two_count = $two_part->users->count();
      $two_url = route('calendar.admin.detail', ['reservePersons' => $two_part  ,'date' => $ymd, 'part' => '2']);
      $html[] = '<a href="' . $two_url . '">';
      $html[] = '<span class="day_part m-0 pt-1">2部 </span>';
      $html[] = '</a>';
      $html[] = '&emsp;';
      $html[] = '<span class="day_part_count m-0 pt-1">'.$two_count.'</span>';
      $html[] = '<br>';
    }
    //3部
    if($three_part){
      $three_count = $three_part->users->count();
      $three_url = route('calendar.admin.detail', ['reservePersons' => $three_part  ,'date' => $ymd, 'part' => '3']);
      $html[] = '<a href="' . $threes_url . '">';
      $html[] = '<span class="day_part m-0 pt-1">3部 </span>';
      $html[] = '</a>';
      $html[] = '&emsp;';
      $html[] = '<span class="day_part_count m-0 pt-1">'.$three_count.'</span>';
      $html[] = '<br>';
    }
    $html[] = '</div>';

    return implode("", $html);
  }

  //スクール枠登録の表示↓
  //スクール枠登録 1部
  function onePartFrame($day){
    $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first();
    if($one_part_frame){
      $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first()->limit_users;
    }else{
      $one_part_frame = "20";
    }
    return $one_part_frame;
  }

  //スクール枠登録 ２部
  function twoPartFrame($day){
    $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first();
    if($two_part_frame){
      $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first()->limit_users;
    }else{
      $two_part_frame = "20";
    }
    return $two_part_frame;
  }

  //スクール枠登録 ３部
  function threePartFrame($day){
    $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first();
    if($three_part_frame){
      $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first()->limit_users;
    }else{
      $three_part_frame = "20";
    }
    return $three_part_frame;
  }
  //スクール枠登録の表示↑

  //
  function dayNumberAdjustment(){
    $html = [];
    $html[] = '<div class="adjust-area">';
    $html[] = '<p class="d-flex m-0 p-0">1部<input class="w-25" style="height:20px;" name="1" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">2部<input class="w-25" style="height:20px;" name="2" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">3部<input class="w-25" style="height:20px;" name="3" type="text" form="reserveSetting"></p>';
    $html[] = '</div>';
    return implode('', $html);
  }
}
