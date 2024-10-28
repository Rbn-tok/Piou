<?php

namespace App\Services\Pocket\Contracts;

use Illuminate\Http\RedirectResponse;

interface PocketAuthenticateInterface
{
    public function authenticate(): RedirectResponse;

    public function callback(): RedirectResponse;
}
