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
        // dd($request);
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
                //予約枠を減らす
                $reserve_settings->users()->attach(Auth::id());
                //attach=くっつける
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    //予約の削除（予約機能と逆の機能をつける）
    public function delete(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            //$getPartにblade(モーダル)から取得した部を代入
            $getData = $request->getData;
            //$getDateにblade(モーダル)から取得した日付を代入
                $reserve_settings = ReserveSettings::where('setting_reserve', $getData)->where('setting_part', $getPart)->first();
                //ReserveSettingsモデル（テーブル）のsetting_reserveカラムに$getDataの値、setting_partに$getPartの値が一致しているレコードを$reserve_settingsに代入する
               $reserve_settings->increment('limit_users');
                //$reserve_settings（削除したい情報が代入された変数）に該当する予約枠（limit_usersカラム）を１増やす
                $reserve_settings->users()->detach( Auth::id());
                //$reserve_settingsと繋がっているユーザー（ReserveSettingsモデルのusersメソッド）を指定し、該当ユーザーを削除する（該当ユーザーはログインユーザーのため、Auth::id()を指定する）
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show',['user_id' => Auth::id()]);
    }

}
