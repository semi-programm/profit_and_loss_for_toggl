<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        // dd($request);
        $flight = Review::updateOrCreate(
            ['id' =>$request->id],
            $request->all()
        );
        return redirect('project');
    }
}
