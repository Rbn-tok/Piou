<?php

namespace App\Services\Pocket\Client;

use App\Models\Setting;
use App\Services\Pocket\Contracts\PocketInterface;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PocketService implements PocketInterface
{
    public function addArticleToPocket($link): RedirectResponse
    {
        $user = Auth::user();

        $accessToken = Setting::where('user_id', $user->id)
            ->where('name', 'pocket')
            ->first();

        if ($accessToken) {
            $client = new Client();
            $token = $accessToken->token;

            $response = $client->post('https://getpocket.com/v3/add', [
                'form_params' => [
                    'consumer_key' => env('POCKET_API_KEY'),
                    'access_token' => $token,
                    'url' => $link->url,
                    'title' => $link->title,
                ],
            ]);
            if (200 === $response->getStatusCode()) {
                $response = $response->getBody();
                $response = json_decode($response);

                return redirect('https://getpocket.com/saves/articles');
            }

            return redirect()->route('home')->with('error', 'L\'ajout de l\'article à échoué');
        }

        return redirect()->route('pocket.auth');
    }
}
