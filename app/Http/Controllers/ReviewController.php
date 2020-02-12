<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Project;
use Carbon\CarbonImmutable as Carbon;

class ReviewController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        Review::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );
        if ($request->is_save === 'false') {
            $project = Project::find($request->project_id);
            $project->update(['finished_at' => Carbon::now()]);
        }
        return redirect('project');
    }
}
