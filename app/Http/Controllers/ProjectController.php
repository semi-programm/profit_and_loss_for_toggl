<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\CarbonImmutable as Carbon;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // なんとなく、ID降順表示で。
        $projects = Project::orderBy('id', 'desc')->whereNull('finished_at')->get();
        $latest_limit = Carbon::now()->subMonth();

        $projects = $this->sumTimeEntries($projects, $latest_limit);

        return view('project.index', compact('projects'));
    }

    public function update(Request $request)
    {
        $project = Project::find($request->id);
        $project->fill($request->all())->save();
        return redirect('project');
    }



    public function view()
    {
        $projects = Project::all();
        return view('project.view', $projects);
    }

    // 時間合計, 最新のtime entryの取得
    public function sumTimeEntries($projects, $latest_limit = null)
    {
        $projects->each(function ($project) use ($latest_limit) {
            $time_entries = $project->timeEntries()->get();
            // time_entriesの合計
            $sum_work_time = $time_entries->sum('duration');
            $project['sum_work_time'] = $sum_work_time / (1000 * 60 * 60);
            // 最新のtime_entryを格納
            $project['latest_entry'] = $project->latestTimeEntry()->first() ? $project->latestTimeEntry()->first()->start : null;
            // 指定日以前のtime_entryがあったら、フラグ
            if ($latest_limit) {
                if ($latest_limit->lt($project->latest_entry)) {
                    $project['is_latest'] = 0;
                } else {
                    $project['is_latest'] = 1;
                }
            }
            // 日付のフォーマット
            $date = new Carbon($project->latest_entry);
            $project->latest_entry = $date->format('Y/m/d');
            // 進捗の割合計算
            if ($project->sum_work_time && $project->est_time) {
                $project['work_time_rate'] = ($project->sum_work_time / $project->est_time) * 100;
            }

            // NOTE:単価はprojectの単価なので、1時間当たりの労働損益がプロジェクトごとに異なる。（もちろん、外注費も）
            if ($project->est_time) {
                $profit_time = $project->est_time - ($project->sum_work_time - ($project->out_price / $project->unit_price)) * (100 / $project->progress);
            }
            if ($project->est_price) {
                $profit_price = $project->est_price - (($project->sum_work_time * $project->unit_price) - $project->out_price) * (100 / $project->progress);
            }
            if ($project->est_time) {
                $remaining_time = $project->est_time - $project->sum_work_time - ($project->out_price / $project->unit_price);
            }
            $project['profit_time'] = $profit_time ?? null;
            $project['profit_price'] = $profit_price ?? null;
            $project['remaining_time'] = $remaining_time ?? null;
        });

        return $projects;
    }
}
