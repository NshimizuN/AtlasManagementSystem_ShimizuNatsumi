@extends('layouts.sidebar')

@section('content')
<div class="reserve-user-container">
  <div class="w-50 m-auto ">
    <p><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
    <div class="reserve-list-box  border">
      <table class="reserveーtable">
        <div class="text-column">
         <tr class="text-center">
          <th class="user-contens" style="color:#fff; background-color: #007bff; border-bottom: solid 1px #e0e4ea;">ID</th>
          <th class="user-contens" style="color:#fff; background-color: #007bff; border-bottom: solid 1px #e0e4ea;">名前</th>
          <th class="user-contens" style="color:#fff; background-color: #007bff; border-bottom: solid 1px #e0e4ea;">場所</th>
         </tr>
      </div>
        @foreach($reservePersons as $reservePerson)
        <!-- 該当予約を単数化にしてリスト表示する -->
        @foreach( $reservePerson->users as $user)
        <!-- $reservePersonに該当するユーザーをReserveSettingモデルのusersメソッド（リレーション定義）から取得、$userに格納してリスト表示する-->
        <tr class="text-center">
          <td class="user-contens">{{ $user->id}}</td>
          <td class="user-contens"><span>{{ $user->over_name}}</span><span>{{ $user->under_name }}</span></td>
          <td class="user-contens"><span>リモート</span></td>
        </tr>
        @endforeach
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection
