<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    /**
     * Show the settings page.
     */
    public function index()
    {
        return view('settings.index', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Update the user's email address.
     */
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'current_password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        
        // Check if email is actually changing
        if ($user->email === $request->email) {
            return back()->with('error', 'New email address is the same as your current email.');
        }

        $user->email = $request->email;
        $user->email_verified_at = null; // Require email verification again
        $user->save();

        // You might want to send email verification here
        // $user->sendEmailVerificationNotification();

        return back()->with('success', 'Email address updated successfully. Please verify your new email.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'different:current_password'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        // Optional: Invalidate other sessions if you want
        // Auth::logoutOtherDevices($request->current_password);

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Show the settings page (alternative method if needed).
     */
    public function show()
    {
        return view('settings', [
            'user' => auth()->user()
        ]);
    }
}