<?php

namespace App\Services\Pocket\Client;

use App\Models\Setting;
use App\Services\Pocket\Contracts\PocketAuthenticateInterface;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PocketAuthenticateService implements PocketAuthenticateInterface
{
    public function authenticate(): RedirectResponse
    {
        $redirectUri = route('pocket.callback');
        $requestToken = $this->getRequestToken($redirectUri);

        session(['pocket_request_token' => $requestToken]);

        return redirect('https://getpocket.com/auth/authorize?request_token=' . $requestToken . '&redirect_uri=' . $redirectUri);
    }

    public function callback(): RedirectResponse
    {
        try {
            $requestToken = Session::get('pocket_request_token');
            $accessToken = $this->getAccessToken($requestToken);
            $indice = strpos($accessToken, '&');
            if (false !== $indice) {
                // Suppression de tous les caractères à partir de l'indice "&"
                $accessToken = substr($accessToken, 0, $indice);
            }

            $user = Auth::user();
            Setting::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'name' => 'Pocket',
                ],
                [
                    'token' => $accessToken,
                ]
            );
        } catch (\Throwable $th) {
            Log::debug('ajout d\'access token dans la base de donnée' . $th->getMessage());
        }

        return redirect()->route('home')->with('success', 'Authentification avec Pocket réussie ! Veuillez ajouter maintenant votre article sur Pocket!');
    }

    private function getRequestToken($redirectUri)
    {
        $client = new Client();
        Log::debug(env('POCKET_API_KEY'));
        try {
            $response = $client->post('https://getpocket.com/v3/oauth/request', [
                'form_params' => [
                    'consumer_key' => env('POCKET_API_KEY'),
                    'redirect_uri' => $redirectUri,
                ],
            ]);

            if (200 === $response->getStatusCode()) {
                $body = $response->getBody()->getContents();

                return substr($body, strlen('code='));
            }

            return redirect()->route('home')->with('error', 'Une erreur occure lors de l\'authentification à Pocket');
        } catch (\Throwable $th) {
            Log::debug('erreur lors de récupération du request token' . $th->getMessage());
        }
    }

    private function getAccessToken($requestToken)
    {
        $client = new Client();
        $response = $client->post('https://getpocket.com/v3/oauth/authorize', [
            'form_params' => [
                'consumer_key' => env('POCKET_API_KEY'),
                'code' => $requestToken,
            ],
        ]);

        $body = $response->getBody()->getContents();

        return substr($body, strlen('access_token='));
    }
}
