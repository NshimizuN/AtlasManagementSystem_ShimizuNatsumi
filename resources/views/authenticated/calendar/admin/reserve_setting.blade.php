@extends('layouts.sidebar')
@section('content')
<div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center; background:#ECF1F6;">
  <div class="border h-55 w-75 m-auto pt-3 pb-3" style="border-radius:5px; background:#FFF; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); ">
        <p class="text-center"style="font-size:1.2rem;" >{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-60 text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection
