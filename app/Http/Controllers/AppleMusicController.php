<?php

namespace App\Http\Controllers;

use App\Services\AppleMusicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AppleMusicController extends Controller
{
    private $tokenService;

    public function __construct(AppleMusicService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function searchArtist(Request $request)
    {

        // dd($request->all());

        $token = $this->tokenService->generateToken();


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.music.apple.com/v1/catalog/us/search', [
            'term' =>$request->input('artist'),
            'types' => 'artists',
        ]);

        // dd($response->json());

        if ($response->failed()) {
            Log::error('Apple Music API Error: ' . $response->body());
            return response()->json([
                'error' => 'Failed to fetch artist.',
                'status' => $response->status(),
                'response' => $response->body(),
            ], $response->status());
        }

        // Return the search results as a JSON response
        return $response->json();
    }

    public function getArtistById($artistId)
    {
        $token = $this->tokenService->generateToken();
        // dd($token);



        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("https://api.music.apple.com/v1/catalog/us/artists/{$artistId}");

        // return $response->json();

        if ($response->failed()) {

            return response()->json([
                'error' => 'Failed to fetch artist.',
                'status' => $response->status(),
                'response' => $response->body(),
            ], $response->status());
        }

        $artist = $response->json();

        return response()->json(['artist' => $artist]);
    }

    public function getAlbums()
    {
        $token = $this->tokenService->generateToken();
        // dd($token);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("https://api.music.apple.com/v1/catalog/us/albums/1616728060");

        // return $response->json();

        if ($response->failed()) {
            // Log or return the actual response for debugging
            return response()->json([
                'error' => 'Failed to fetch albums.',
                'status' => $response->status(),
                'response' => $response->body(),
            ], $response->status());
        }

        $artist = $response->json();

        return response()->json(['artist' => $artist]);

    }

}
