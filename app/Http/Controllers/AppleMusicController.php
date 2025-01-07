<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppleMusicController extends Controller
{
    public function redirectToAppleMusic()
    {
        $developerToken = Helper::generateAppleClientSecret();

        return response()->json(['developerToken' => $developerToken]);
    }

    public function handleAppleMusicCallback(Request $request)
    {
        $userToken = $request->input('userToken');
        if (!$userToken) {
            return response()->json(['error' => 'User token is required'], 400);
        }

        // Save or use the user token for Apple Music API requests
        return response()->json(['message' => 'User token received successfully', 'userToken' => $userToken]);
    }

    // public function getArtistDetails($id, Request $request)
    // {
    //     $storefront = $request->query('storefront', 'us'); // Default storefront is 'bd'
    //     $developerToken = $this->generateDeveloperToken();

    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . $developerToken,
    //     ])->get("https://api.music.apple.com/v1/catalog/{$storefront}/search", [
    //         'term' => 'Taylor Swift',
    //         'types' => 'artists',
    //     ]);
    //     if ($response->failed()) {
    //         return response()->json([
    //             'error' => 'Unable to fetch artist details',
    //             'status' => $response->status(),
    //             'body' => $response->body(),
    //         ], $response->status());
    //     }

    //     return $response->json();
    // }

    // private function generateDeveloperToken()
    // {

    //     $teamId = env('APPLE_TEAM_ID');
    //     // $clientId = env('APPLE_CLIENT_ID');
    //     $keyId = env('APPLE_KEY_ID');
    //     $privateKey = env('APPLE_PRIVATE_KEY_PATH');
    //     $claims = [
    //         'iss' => $teamId,
    //         'iat' => time(),
    //         'exp' => time() + (60 * 60 * 24 * 180), // Valid for 6 months
    //         'aud' => 'https://appleid.apple.com',
    //     ];

    //     // Debugging: Output token and claims
    //     $token = JWT::encode($claims, $privateKey, 'ES256', $keyId);
    //     // dd([
    //     //     'claims' => $claims,
    //     //     'token' => $token,
    //     // ]);

    //     return $token;
    // }
}
