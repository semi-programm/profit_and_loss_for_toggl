<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $flight = Review::create($request->all());
        return redirect('project');
    }
}
