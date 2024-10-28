<?php

namespace App\Services\Feed\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface FeedReaderInterface
{
    public function discover(string $feed): Collection;

    public function links(string $feed): Collection;

    public function about(string $feed): Model;
}
