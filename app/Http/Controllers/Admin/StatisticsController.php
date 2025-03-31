<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // Return the statistics view for the /admin/statistics route
        return view('admin.statistics.index');
    }
}
