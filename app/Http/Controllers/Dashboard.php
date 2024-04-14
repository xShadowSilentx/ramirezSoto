<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Display the dashboard request view.
     */
    public function create(Request $request)
    {
        $roles = $request->user()->roles;

        $conventionalUsers = $request->user()::whereHas('roles', function ($query) {
            $query->where('roles_id', 2);
        })->get();

        $usersData = [];

        foreach ($conventionalUsers as $user) {
            $usersData[] = [
                'id' => $user->id,
                'name' => $user->name,  
                'phone' => $user->phone,  
                'categoriesSelected' => $user->categories->pluck('description'), 
                'notificationsSelected' => $user->notifications->pluck('type')
            ];
        }

        return view(
            'dashboard',
            [
                'roles' => $roles,
                'usersData' => $usersData,
                'categories' => $this->categories,
                'notifications' => $this->notifications,
            ]
        );
    }
}
