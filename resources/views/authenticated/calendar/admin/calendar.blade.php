@extends('layouts.sidebar')

<!-- スクール予約確認 -->
@section('content')
<div class="vh-100 pt-4" style="background:#ECF1F6; ">
  <div class="border h-55 w-75 m-auto pt-3 pb-3" style="border-radius:5px; background:#FFF; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); ">
      <p class="text-center" style="font-size:1.5rem;">{{ $calendar->getTitle() }}</p>
<div class="w-75 m-auto">
      <div class="text-center" >
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
  </div>
  </div>

@endsection
