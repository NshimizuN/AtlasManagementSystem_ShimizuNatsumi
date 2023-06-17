<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// CalendarViewをコントローラーから使う
use App\Calendars\General\CalendarView;

use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\Calendars\Calendars;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    // スクール予約を表示する
    public function show(){
        // CalendarViewクラスは例えば次のように呼び出して使う、time()を使って現在時刻を渡す
        $calendar = new CalendarView(time());

        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    // スクール予約から予約をする
    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            // dd($getPart);
            $getData = $request->getData;
            // dd($getDate);
            $reserveDays = array_filter(array_combine($getData, $getPart));
            //$getDate=キー,$getPart=値
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    //予約の削除
    public function delete($id){
        dd("123");
        // $id = $request->id;
        \DB::table('reserve_setting_users')
        ->findOrFail($id)
        ->delete();
        return redirect()->route('calendar.general.show');
    }

}
