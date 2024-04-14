<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    { 

        $categoriesSelected = $request->user()->categories;
        $notificationsSelected = $request->user()->notifications;

        return view('profile.edit', [
            'user' => $request->user(),
            'categories' => $this->categories,
            'notifications' => $this->notifications,
            'categoriesSelected' => $categoriesSelected,
            'notificationsSelected' => $notificationsSelected,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $selectedCategories = $request->input('categories', []);
        $selectedNotifications = $request->input('notification', []);

        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();


        $user->categories()->sync($selectedCategories);
        $user->notifications()->sync($selectedNotifications);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
