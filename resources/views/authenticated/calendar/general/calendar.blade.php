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


<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
      <div class="w-100">
        <div class="modal-inner-date w-50 m-auto">

          <div class="modal-inner-day w-50 m-auto">
           <p class="get-date">予約日：<span class="get-date" name="getData"></span></p>
           <input type="hidden"  name="getData" value="getData" form="deleteParts">
          </div>

          <div class="modal-inner-part w-50 m-auto">
           <p class="get-date">時間：リモ<span class="get-date" name="getPart" ></span>部</p>
           <input type="hidden"  name="getPart" value="getPart"form="deleteParts">
          </div>

          <br>

          <p>上記予約をキャンセルしてもよろしいでしょうか？</p>
        </div>

        <div class="w-50 m-auto delete-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="delete-modal-hidden" name="reserve_settings" value="reserve_settings" form="deleteParts">
          <input type="submit"  class="btn btn-primary d-block" value="キャンセル" form="deleteParts">
        </div>

      </div>
  </div>
</div>

@endsection
