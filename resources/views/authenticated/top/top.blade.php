@extends('layouts.sidebar')

@section('content')

<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <p class="mypage">マイページ</p>
    <div class="user_status p-3">
       <img src="/images/icon1.png" alt="初期アイコン" width="70" height="70">
    <div class="mypage-prf">
      <div class="mypage-name">
        <p><strong>名前</strong></p>
        <span>{{ Auth::user()->over_name }}</span><span class="ml-1">{{ Auth::user()->under_name }}</span>
     </div>
     <div class="mypage-kana">
      <p><strong>カナ</strong></p>
      <span>{{ Auth::user()->over_name_kana }}</span><span class="ml-1">{{ Auth::user()->under_name_kana }}</span>
    </div>
    <div class="mypage-sex">
      <p><strong>性別</strong></p>
      @if(Auth::user()->sex == 1)<span>男</span>@else<span>女</span>@endif
    </div>
    <div class="mypage-barth">
      <p><strong>生年月日</strong></p>
      <span>{{ Auth::user()->birth_day }}</span>
    </div>
    </div>
    </div>
  </div>
</div>
@endsection
