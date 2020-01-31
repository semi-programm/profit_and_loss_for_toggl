<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Carbon;
use Yasumi\Yasumi;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        // $this_month = Carbon::now()->month;

        // $users->each(function($user) use ($this_month){
        //     $times = $user->timeEntries()->whereMonth('start', '=' ,$this_month)->get();
        //     $sum_time = $times->sum('duration'); //単位はms
        //     $user['sum_time'] = $sum_time/(1000*60*60);
        // });

        $startDate = Carbon::now();
        $endDate = Carbon::now()->endOfMonth();
        $weekdays = $this->Weekdays($startDate, $endDate);
        dump($weekdays);
        $year = Carbon::now()->year()->toDateString();

        // return view ('user.index', ['users' => $users]);
    }

    public function view()
    {
        $users = User::all();
        return view('user.view', $users);
    }

    public function Weekdays($startDate, $endDate)
    {
        $start_date_p = $startDate;
        $year = $startDate->year()->toDateString();
        // 土日を除く平日を取得
        $days = (int) $start_date_p->diffInDaysFiltered(
            function (Carbon $date) {
                return $date->isWeekday();
            },
            $endDate
        );

        // 祝日を取得
        $holidays = Yasumi::create('Japan', $year, 'ja_JP');

        $holidaysInBetweenDays = $holidays->between(
            \DateTime::createFromFormat('m/d/Y', $startDate->format('m/d/Y')),
            \DateTime::createFromFormat('m/d/Y', $endDate->format('m/d/Y'))
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
