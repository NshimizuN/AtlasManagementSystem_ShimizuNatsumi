@extends('layouts.sidebar')

<!-- スクール予約 -->
@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

    <!-- CalendarViewの各関数を利用して、タイトルを出力 -->
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
         <!-- CalendarViewの各関数を利用して、カレンダーを出力 -->
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

 <!-- <button id="modalOpen" class="button">Click Me</button> -->
  <!-- <div id="easyModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h1>Great job 🎉</h1>
        <span class="modalClose">閉じる</span>
      </div>
      <div class="modal-body">
        <p>You've just displayed this awesome Modal Window!</p>
        <p>Let's enjoy learning JavaScript ☺️</p>
      </div>
    </div>
  </div>
  <script src="calendar.js"></script> -->

  <div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{route('deleteParts')}}" method="post">
      <div class="w-100">
        <div class="modal-inner-date w-50 m-auto">
          <!-- <input type="text" name="post_title" placeholder="タイトル" class="w-100"> -->

          <p>予約日：<span>$getDate</span></p>
          <p>時間：<span>$getPart</span></p>
          <br>
          <p>上記予約をキャンセルしてもよろしいでしょうか？</p>
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <!-- <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea> -->
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="delete-modal-hidden" name="post_id" value="">
          <input type="submit"  class="btn btn-primary d-block" value="キャンセル">
        </div>
      </div>
      <!-- {{ csrf_field() }} -->
    </form>
  </div>
</div>

@endsection
