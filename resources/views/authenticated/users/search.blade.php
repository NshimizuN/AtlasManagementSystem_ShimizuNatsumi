@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100  d-flex">

  <!-- ユーザー一覧 -->
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <img src="images/icon5.png" alt="テスト">
      <!-- <img src="images/icon5.png" alt="テスト"> -->
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span>男</span>
        @else
        <span>性別 : </span><span>女</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span>講師(英語)</span>
        @else
        <span>権限 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>選択科目 :
          @foreach($user->subjects as $subject)
        {{ $subject->subject }}
        @endforeach
        </span>
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <!-- 検索 -->
  <div class="search_area w-25 border">
    <!-- キーワード検索 -->
    <div class="">
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <!-- カテゴリ -->
    <div>
        <lavel>カテゴリ</lavel>
        <select form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <!-- 並び替え -->
      <div>
        <label>並び替え</label>
        <select name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>

      <!-- 検索条件の追加 -->
      <div class="">
        <p class="m-0 search_conditions"><span>検索条件の追加</span></p>
        <!-- <div class="search_conditions_inner"> -->
          <!-- 性別 -->
          <div>
            <label>性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
          </div>
          <!-- 権限 -->
          <div>
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <br>
          <!-- 選択科目 -->
          <div class="">
            <label class="selected_subjects">選択科目</label>
            @foreach($subjects as $subject)
            <input type="checkbox" id="subject_{{ $subject->id }}" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
            <label for="subject_{{ $subject->id }}">{{ $subject->subject }}</label>
            @endforeach
          </div>
        <!-- </div> -->
      </div>
      <!-- リセットボタン -->
      <div>
        <input type="reset" value="リセット" form="userSearchRequest">
      </div>
      <!-- 検索ボタン -->
      <div>
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
