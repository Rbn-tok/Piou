<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Services\Pocket\Contracts\PocketAuthenticateInterface;
use App\Services\Pocket\Contracts\PocketInterface;

class PocketCtrl extends Controller
{
    private $pocketAuth;
    private $pocketService;

    public function __construct(PocketAuthenticateInterface $pocketAuth, PocketInterface $pocketService)
    {
        $this->pocketAuth = $pocketAuth;
        $this->pocketService = $pocketService;
    }

    public function authenticate()
    {
        return $this->pocketAuth->authenticate();
    }

    public function callback()
    {
        return $this->pocketAuth->callback();
    }

    public function addArticle($link)
    {
        $link = Link::find($link);

        return $this->pocketService->addArticleToPocket($link);
    }
}
