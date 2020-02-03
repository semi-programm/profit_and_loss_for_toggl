<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\CarbonImmutable as Carbon;

class ProjectController extends Controller
{
    public function index (Request $request)
    {
        // なんとなく、ID降順表示で。
        $projects = Project::orderBy('id', 'desc')->get();
        $latest_limit = Carbon::now()->subMonth();

        // 時間合計, 最新のtime entryの取得
        $projects->each(function($project) use ($latest_limit){
            $time_entries = $project->timeEntries()->get();
            // time_entriesの合計
            $sum = $time_entries->sum('duration');
            $project['sum'] = $sum/(1000*60*60);
            // 最新のtime_entryを格納
            $project['latest_entry'] = $project->latestTimeEntry()->first() ? $project->latestTimeEntry()->first()->start : null;
            // 指定日以前のtime_entryがあったら、フラグ
            if ($latest_limit->lt($project->latest_entry)) {
                $project['is_latest'] = 0;
            }else{
                $project['is_latest'] = 1;
            }
            // 日付のフォーマット
            $date = new Carbon($project->latest_entry);
            $project->latest_entry = $date->format('Y/m/d');
            // 進捗の割合計算
            if($project->sum && $project->est_time){
                $project['cal_progress'] = ($project->sum/$project->est_time)*100;
            }
        });

        return view('project.index', compact('projects'));
    }

    public function view ()
    {
        $projects = Project::all();
        return view('project.view', $projects);
    }
}
