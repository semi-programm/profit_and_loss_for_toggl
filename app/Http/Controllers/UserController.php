<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Model\User;
use Carbon\CarbonImmutable as Carbon;
use Yasumi\Yasumi;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        // $this_month = Carbon::now()->month;
        $this_month = Carbon::now()->subMonth()->month;

        // 労働時間合計
        $users->each(function($user) use ($this_month){
            $times = $user->timeEntries()->whereMonth('start', '=' ,$this_month)->get();
            $sum_time = $times->sum('duration'); //単位はms
            $user['working_time'] = $sum_time/(1000*60*60);
        });

        // 平日日数
        $startDate = Carbon::now();
        $endDate = $startDate->endOfMonth();
        $weekdays = $this->getWeekdays($startDate, $endDate);

        // 残業時間
        $users->each(function($user) use($weekdays)
        {
            $office_hours = $weekdays*8;
            $overtime_hours = $user->working_time - $office_hours;
            $user['overtime'] = $overtime_hours;
        });

        return view ('user.index', ['users' => $users]);
    }

    public function view()
    {
        $users = User::all();
        return view('user.view', $users);
    }

    public function getWeekdays(Carbon $start_date, Carbon $end_date): int
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
