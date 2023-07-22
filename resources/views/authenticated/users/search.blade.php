@extends('layouts.sidebar')

@section('content')
<div class="search_content  d-flex">

  <!-- ユーザー一覧 -->
  <div class="reserve_users_container">
   <div class="reserve_users_area" style="display: flex; flex-wrap: wrap; justify-content: flex-start;" >
    @foreach($users as $user)
    <div class="border one_person" style="display: flex; flex-wrap: wrap; justify-content: flex-start;"  >
      <div class="reserve_users_id" >
        <span>ID : </span><span><b>{{ $user->id }}</b></span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span><b>{{ $user->over_name }}</b></span>
          <span><b>{{ $user->under_name }}</b></span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>(<b>{{ $user->over_name_kana }}</b></span>
        <span><b>{{ $user->under_name_kana }}</b>)</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span><b>男</b></span>
        @else
        <span>性別 : </span><span><b>女</b></span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span><b>{{ $user->birth_day }}</b></span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span><b>教師(国語)</b></span>
        @elseif($user->role == 2)
        <span>権限 : </span><span><b>教師(数学)</b></span>
        @elseif($user->role == 3)
        <span>権限 : </span><span><b>講師(英語)</b></span>
        @else
        <span>権限 : </span><span><b>生徒</b></span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>選択科目 :</span>
          @foreach($user->subjects as $subject)
        <span><b>{{ $subject->subject }}</b></span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>

  <!-- 検索 -->
  <div class="search_area_container">
  <div class="search_area w-25 ">
    <div class="user-sarch-box">
     <h2 class="user-sarch-title">検索</h2>
   </div>
    <!-- キーワード検索 -->
    <div class="">
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="  キーワードを入力" form="userSearchRequest">
      </div>
      <!-- カテゴリ -->
    <div class="category-box">
        <lavel class="category-title">カテゴリ</lavel>
        <select form="userSearchRequest" name="category" class="category-form">
          <option value="name">名前</option>
          <option value="id"> 社員ID</option>
        </select>
      </div>
      <!-- 並び替え -->
      <div class="order-box">
        <label class="order-title">並び替え</label>
        <select name="updown" form="userSearchRequest" class="order-form">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>

      <!-- 検索条件の追加 -->
      <div class="conditions-container">
        <div class="conditions-title-box">
          <span>検索条件の追加</span>
        </div>
       <div class="conditions-box">
          <!-- 性別 -->
          <div class="sex-box">
            <label class="sex-title">性別</label>
            <div class="sex-container">
             <span>男</span><input type="radio" class="radio" name="sex" value="1" form="userSearchRequest">
             <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
           </div>
          </div>
          <!-- 権限 -->
          <div class="engineer-box">
            <label class="engineer-title">権限</label>
            <select name="role" form="userSearchRequest" class="engineer-form">
              <option selected disabled>----</option>
              <div><option value="1">教師(国語)</option></div>
              <div><option value="2">教師(数学)</option></div>
              <div><option value="3">教師(英語)</option></div>
              <div><option value="4" class="">生徒</option></div>
            </select>
          </div>
          <br>
          <!-- 選択科目 -->
          <div class="subjects-box">
            <label class="selected_title">選択科目</label>
            <div class="subjects-container">
            @foreach($subjects as $subject)
            <div><input type="checkbox" id="subject_{{ $subject->id }}" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
            <label for="subject_{{ $subject->id }}">{{ $subject->subject }}</label></div>
            @endforeach
        </div>
          </div>
        <!-- </div> -->
      </div>
      </div>
      <!-- 検索ボタン -->
      <div class="user-search-btnbox">
        <button type="submit"  class="user-search-btn"  name="search_btn" value="検索" form="userSearchRequest"><i class="fa fa-search" aria-hidden="true" form="userSearchRequest"></i>&ensp;検索する</button>
      </div>

            <!-- リセットボタン -->
      <div class="reset-btn-box">
        <input type="reset" class="reset-btn" value="リセット" form="userSearchRequest">
        <form id="userSearchRequest"></form>
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
</div>
@endsection
