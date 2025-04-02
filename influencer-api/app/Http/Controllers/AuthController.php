<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Http;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['message' => 'User registered successfully!'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
    
  

public function fetchChannelDetails(Request $request)
    {
        $request->validate([
            'channel_url' => 'required'
        ]);
        $channelId = $this->extractChannelId($request->channel_url);
        if (!$channelId) {
            return back()->with('error', 'Invalid YouTube URL or ID');
        }

        $apiKey =env('Api_Key_Youtube');
        $url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&id={$channelId}&key={$apiKey}";

        $response = Http::get($url);
        dd($response->json());
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['items'])) {
                $stats = $data['items'][0]['statistics'];
                return back()->with('data', [
                    'subscribers' => $stats['subscriberCount'],
                    'views' => $stats['viewCount'],
                    'videos' => $stats['videoCount']
                ]);
            }
        }

        return back()->with('error', 'Channel not found');
    }

    private function extractChannelId($url)
    {
        if (preg_match('/youtube\.com\/channel\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }
        if (preg_match('/youtube\.com\/@([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $this->getChannelIdFromUsername($matches[1]);
        }
        return $url;
    }

    private function getChannelIdFromUsername($username)
    {
        $apiKey =env('Api_Key_Youtube');
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=channel&q={$username}&key={$apiKey}";
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['items'])) {
                return $data['items'][0]['id']['channelId'];
            }
        }
        return null;
    }


    // facebook
    // public function getPagePosts()
    // {
    //     $pageId = env('FACEBOOK_PAGE_ID');
    //     $accessToken = env('FACEBOOK_ACCESS_TOKEN');
    
    //     $url = "https://graph.facebook.com/v18.0/{$pageId}/posts?fields=id,message,created_time,likes.summary(true),comments.summary(true)&access_token={$accessToken}";
    
    //     $response = Http::get($url);
    
    //     return response()->json($response->json());
    // }
    
    public function getUserDetails(Request $request)
    {
        $facebookUrl = 'https://www.facebook.com/saipalllavi';

        // Facebook Username Extract Karo (https://www.facebook.com/username)
        $username = basename(parse_url($facebookUrl, PHP_URL_PATH));

        $accessToken ='EAATuEjRd8tUBOZBwtEVxTskJLNuQ4CRHrrYWLX8FDx4ljcVlRJDxQF5SphvNvMhVCNM345T4sqtrzWJpnHZAgJabL4REfrwOpoP8QNivUKPT51uQt8OWnx93AmxoxyacqNarAKZCCEjnWzKtGNuT67tzhuueWF0tALJbKvP4SRxIVXTPIB8ktltRHZBMlKdys9raINwwArJKQKeGQ16QulBKHY6XNENCICkZD';

        // User ke details fetch karne ka Graph API URL
        $url = "https://graph.facebook.com/v18.0/{$username}?fields=id,name,followers_count,photos.limit(5){images},videos.limit(5){source,views}&access_token={$accessToken}";

        $response = Http::get($url);

        return response()->json($response->json());
    }
}
