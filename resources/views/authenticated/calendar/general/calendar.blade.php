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
  <div id="easyModal" class="modal">
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
  <script src="calendar.js"></script>

@endsection
