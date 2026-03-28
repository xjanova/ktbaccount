<?php

namespace App\Http\Controllers\Fund;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('fund.dashboard');
    }
}
