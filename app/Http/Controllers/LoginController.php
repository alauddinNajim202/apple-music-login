<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }







    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('apple')->stateless()->user();

            // Example: Use $user->id, $user->email, etc., to find or create a user
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                auth()->login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $user->name ?? 'Apple User',
                    'email' => $user->email,
                    'apple_id' => $user->id,
                ]);
                auth()->login($newUser);
            }

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Unable to login with Apple.');
        }
    }
}
