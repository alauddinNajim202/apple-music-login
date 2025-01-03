<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Http;

class AppleAuthController extends Controller
{
    public function redirectToApple()
    {
        $params = [
            'response_type' => 'code',
            'client_id' => env('APPLE_SIGNIN_CLIENT_ID'),
            'redirect_uri' => env('APPLE_SIGNIN_REDIRECT_URI'),
            'scope' => 'name email',
            'state' => csrf_token(),
            'response_mode' => 'form_post',
        ];


        // dd('https://appleid.apple.com/auth/authorize?' . http_build_query($params));
        return   redirect('https://appleid.apple.com/auth/authorize?' . http_build_query($params));


    }

    public function handleAppleCallback(Request $request)
    {
        // dd($request->all());
        $authorizationCode = $request->input('code');

        if (!$authorizationCode) {
            return redirect()->route('login')->withErrors(['message' => 'Authorization failed.']);
        }


        $response = Http::asForm()->post('https://appleid.apple.com/auth/token', [
            'grant_type' => 'authorization_code',
            'code' => $authorizationCode,
            'redirect_uri' => env('APPLE_SIGNIN_REDIRECT_URI'),
            'client_id' => env('APPLE_SIGNIN_CLIENT_ID'),
            'client_secret' => $this->generateClientSecret(),
        ]);

        $data = $response->json();


        if (!isset($data['id_token'])) {
            return redirect()->route('login')->withErrors(['message' => 'Failed to retrieve ID token.']);
        }


        $idToken = $data['id_token'];
        $claims = JWT::decode($idToken, new Key(file_get_contents(env('APPLE_MUSIC_PRIVATE_KEY_PATH')), 'RS256'));

        // Process user info
        $email = $claims->email ?? null;
        $userIdentifier = $claims->sub;


        // User::updateOrCreate(['apple_id' => $userIdentifier], ['email' => $email]);

        return redirect('/')->with('message', 'Successfully logged in!');
    }

    private function generateClientSecret()
    {
        $key = file_get_contents(base_path(env('APPLE_MUSIC_PRIVATE_KEY_PATH')));

        $payload = [
            'iss' => env('APPLE_MUSIC_TEAM_ID'),
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24),
            'aud' => 'https://appleid.apple.com',
            'sub' => env('APPLE_SIGNIN_CLIENT_ID'),
        ];

        return JWT::encode($payload, $key, 'RS256', env('APPLE_MUSIC_KEY_ID'));
    }
}
