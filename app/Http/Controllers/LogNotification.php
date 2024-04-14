<?php

namespace App\Http\Controllers;

use App\Models\LogHistory;
use Illuminate\Http\Request;
use App\Models\User;

class LogNotification extends Controller
{
    /**
     * Display log notification view.
     */
    public function create(Request $request)
    {
        $roles = $request->user()->roles;

        $logHistories = LogHistory::with(['user', 'notification', 'category'])->get();

        return view('logNotification', ['roles' => $roles, 'logHistories' => $logHistories]);
    }
}
