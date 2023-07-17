@extends('layouts.sidebar')

@section('content')

<div class="vh-100 border">
  <p class="mypage">自分のプロフィール</p>
  <div class="top_area w-75 m-auto pt-5">
    <div class="user_status p-3">
    <div class="mypage-prf">
      <div class="mypage-name">
        <p>名前：
        <span>{{ Auth::user()->over_name }}</span><span class="ml-1">{{ Auth::user()->under_name }}</span></p>
     </div>
     <div class="mypage-kana">
      <p>カナ：
      <span>{{ Auth::user()->over_name_kana }}</span><span class="ml-1">{{ Auth::user()->under_name_kana }}</span></p>
    </div>
    <div class="mypage-sex">
      <p>性別：
      @if(Auth::user()->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
    </div>
    <div class="mypage-barth">
      <p>生年月日：
      <span>{{ Auth::user()->birth_day }}</span></p>
    </div>
    </div>
    </div>
  </div>
</div>
@endsection
