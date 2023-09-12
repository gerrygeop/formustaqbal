<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilesInformationUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Local;
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
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        if ($user->siakad) {
            $locals = Local::where('department_id', $user->siakad->department_id)->get();
        }

        return view('profile.edit', [
            'user' => $user,
            'locals' => $locals ?? null,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfiles(ProfilesInformationUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profiles-information-updated');
    }

    public function updateLocal(Request $request)
    {
        $validated = $request->validate([
            'local' => ['required', 'exists:locals,id']
        ]);

        $request->user()->siakad()->update([
            'local_id' => $validated['local']
        ]);

        return Redirect::route('profile.edit')->with('status', 'profiles-local-updated');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
