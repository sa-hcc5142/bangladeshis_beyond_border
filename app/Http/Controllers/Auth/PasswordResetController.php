<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PasswordResetController extends Controller
{
    /**
     * Show the password reset form.
     */
    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    /**
     * Handle the password reset request.
     */
    public function update(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'email.exists' => 'We could not find an account with this email address.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'We could not find an account with this email address.',
            ])->withInput();
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('home')->with('success', 'Your password has been updated successfully! Please login with your new password.');
    }
}
