@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <div class="user-profile-box">
     <span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span>
     <div class="search-user-status p-3">
      <div class="mypage-name">
        <p>名前：{{ $user->over_name }}<span class="ml-1">{{ $user->under_name }}</span></p>

      </div>
        <div class="mypage-kana">
          <p>カナ：<span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
     </div>
     <div class="mypage-sex">
      <p>性別：@if(Auth::user()->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
     </div>
     <div class="mypage-barth">
      <p>生年月日：<span>{{ Auth::user()->birth_day }}</span></p>
     </div>
     <div class="mypage-subject">
       <p>選択科目： @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach</p>
     </div>

      <div class="subject-edit">
        @can('admin')
        <div class="post-page">
         <p class="subject_edit_btn">選択科目の編集</p>
       </div>
        <div class="subject_inner">
          <form action="{{ route('user.edit') }}" method="post">
            <div class="subject-list">
              <div>
            @foreach($subject_lists as $subject_list)
              <label class="subject-item">{{ $subject_list->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
            @endforeach
            </div>
            <div class="subject-post-btn">
            <input type="submit" value="登録" class="btn btn-primary">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            {{ csrf_field() }}
                        </div>
          </div>
          </form>
        </div>
        @endcan
    </div>

      </div>
    </div>
  </div>
</div>

@endsection
