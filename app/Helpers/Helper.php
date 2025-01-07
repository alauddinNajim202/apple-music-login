<?php

namespace App\Helpers;

use Firebase\JWT\JWT;

class Helper
{
    static function generateAppleClientSecret()
    {
        $teamId = env('APPLE_TEAM_ID');
        $clientId = env('APPLE_CLIENT_ID');
        $keyId = env('APPLE_KEY_ID');
        $privateKey = env('APPLE_PRIVATE_KEY_PATH');

        $claims = [
            'iss' => $teamId, // Team ID from Apple Developer account
            'iat' => time(), // Current timestamp
            'exp' => time() + (60 * 60 * 24 * 180), // Token validity (max 6 months)
            'aud' => 'https://appleid.apple.com',
            'sub' => $clientId, // Service ID (Client ID)
        ];

        return JWT::encode($claims, $privateKey, 'ES256', $keyId);
    }

}
