<?php

namespace App\Http\Controllers;

use App\Models\LogHistory;
use App\Models\User;
use Illuminate\Http\Request;

class SendMessage extends Controller
{

    /**
     * Display send notification view.
     */
    public function create(Request $request, $id)
    {
        $roles = $request->user()->roles;

        $user = User::findOrFail($id);

        $categoriesSelected = $user->categories;
        $notificationsSelected = $user->notifications;

        return view("sendMessage", [
            'user' => $user,
            'roles' => $roles,
            'categoriesSelected' => $categoriesSelected,
            'notificationsSelected' => $notificationsSelected,
            'categories' => $this->categories,
            'notifications' => $this->notifications,
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'message' => ['required', 'min:5'],
            'categories' => ['required'],
            'notification' => ['required']
        ]);



        $logHistory = new LogHistory([
            'users_id' => $request->id_user,
            'notifications_id' => $request->notification,
            'categories_id' => $request->categories,
            'message' => $request->message
        ]);

        $logHistory->save();

        return redirect()->route('dashboard')->with('success-notification', 'ok');
    }
}
