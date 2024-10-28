<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un utilisateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $payload = [];

        $payload['firstname'] = $this->ask(__('Quel est le nom ?'));
        $payload['lastname'] = $this->ask(__('Quel est le prénom ?'));

        do {
            $payload['email'] = $this->ask(__('Quel est l\'adresse email ?'));
        } while (User::query()->firstWhere('email', $payload['email']));

        $payload['password'] = $this->ask(__('Quel est le mot de passe ?'));

        User::create($payload);
    }
}
