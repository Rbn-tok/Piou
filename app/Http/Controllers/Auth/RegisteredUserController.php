<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Événement d'inscription
        event(new Registered($user));

        // Authentifier l'utilisateur
        Auth::login($user);

        // Ajouter des flux RSS par défaut
        $defaultFeeds = [
            ['name' => 'Laravel Blog', 'url' => 'https://blog.laravel.com/feed'],
            ['name' => 'Korben Info', 'url' => 'https://korben.info/feed'],
            ['name' => 'LinuxFr', 'url' => 'https://linuxfr.org/news.atom'],
            ['name' => 'Feedburner', 'url' => 'https://feeds.feedburner.com/d0od'],
        ];

        foreach ($defaultFeeds as $feedData) {
            Feed::create([
                'name' => $feedData['name'],
                'url' => $feedData['url'],
                'user_id' => $user->id, // Associer le flux à l'utilisateur
            ]);
        }

        return redirect(route('dashboard', absolute: false));
    }
}
