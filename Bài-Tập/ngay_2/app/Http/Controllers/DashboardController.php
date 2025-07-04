<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Xử lý request dashboard admin (single action)
     */
    public function __invoke()
    {
        // Trả về view resources/views/admin/dashboard.blade.php
        return view('admin.dashboard');
    }
}
