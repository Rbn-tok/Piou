<?php

namespace App\Helpers;

use App\Models\Link as Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait Link
{
    private function getLinks(Carbon $startedAt, ?Carbon $endedAt = null)
    {
        return Model::query()
            ->where('user_id', Auth::id())
            ->with('feed')
            ->whereNull('read_at')
            ->where('published_at', '>=', $startedAt)
            ->when($endedAt, function ($query, $endedAt) {
                $query->where('published_at', '<', $endedAt->format('Y-m-d 00:00:00'));
            })
            ->orderBy('published_at', 'desc')
            ->paginate(25);
    }
}
