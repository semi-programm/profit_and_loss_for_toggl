<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\CarbonImmutable as Carbon;
use Yasumi\Yasumi;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        $this_month = Carbon::now()->month;

        // 労働時間合計
        $users->each(function($user) use ($this_month){
            $time_entries = $user->timeEntries()->whereMonth('start', '=' ,$this_month)->get();
            $sum_time = $time_entries->sum('duration'); //単位はms
            $user['working_time'] = $sum_time/(1000*60*60);
        });

        // 平日日数
        $weekdays = $this->getWeekdays(Carbon::now(), Carbon::now()->endOfMonth());

        // 出勤日数
        $worked_days = $this->getWeekdays(Carbon::now()->firstOfMonth(), Carbon::now());

        // 残業時間
        $users->each(function($user) use($worked_days)
        {
            $office_hours = $worked_days*8;
            $overtime_hours = $user->working_time - $office_hours;
            $user['overtime'] = $overtime_hours;
        });

        // コミット数
        $users->each(function($user) use ($this_month){
            $time_entries = $user->timeEntries()->whereMonth('start', '=' ,$this_month)->get();
            $user['commit_number'] = $time_entries->groupBy('project_id')->count();
        });

        return view ('user.index', compact('users', 'weekdays'));
    }

    public function show($user_id)
    {
        $user = User::find($user_id);
        return view('user.view', compact('user'));
    }

    public function destroy($user_id)
    {
        User::find($user_id)->delete();

        return redirect('/')->with('flash_message', 'Post Added!');
    }

    private function getWeekdays(Carbon $start_date, Carbon $end_date): int
    {
        $year = $start_date->year;
        // 土日を除く平日を取得
        $days = (int) $start_date->diffInDaysFiltered(
            function (Carbon $date) {
                return $date->isWeekday();
            },
            $end_date
        );

        // 祝日を取得
        $holidays = Yasumi::create('Japan', $year, 'ja_JP');

        $holidaysInBetweenDays = $holidays->between(
            \DateTime::createFromFormat('m/d/Y', $start_date->format('m/d/Y')),
            \DateTime::createFromFormat('m/d/Y', $end_date->format('m/d/Y'))
        );

        $numberOfHoliday = 0;
        foreach ($holidaysInBetweenDays as $holiday) {
            if ((new Carbon($holiday))->isWeekend() === false) {
                $numberOfHoliday++;
            }
        }

        // さらに祝日の数を引いた平日の日数を取得
        $numberOfDay = $days - $numberOfHoliday;

        // 出力
        return $numberOfDay;
    }
}
