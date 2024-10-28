<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\MarkListAsReadRequest;
use App\Models\Link;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LinkCtrl extends Controller
{
    private function getLinks(Carbon $startedAt, ?Carbon $endedAt = null)
    {
        return Link::query()
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

    public function index(): View
    {
        $links = $this->getLinks(now()->startOfDay());

        return view(
            view: 'pages.links.index',
            data: compact('links')
        );
    }

    public function yesterday(): View
    {
        $links = $this->getLinks(
            now()->subDays(1)->startOfDay(),
            now()->startOfDay()
        );

        return view(
            view: 'pages.links.yesterday',
            data: compact('links')
        );
    }

    public function week(): View
    {
        $links = $this->getLinks(
            now()->subWeek()->startOfDay(),
            now()->subDays(1)->startOfDay()
        );

        return view(
            view: 'pages.links.week',
            data: compact('links')
        );
    }

    public function show(Link $link): View
    {
        abort_if(
            $link->user_id != Auth::id(),
            Response::HTTP_FORBIDDEN,
            __("Ce lien n'est pas disponible.")
        );

        if (!$link->read_at) {
            $link->update([
                'read_at' => now(),
            ]);
        }

        return view('pages.links.show', compact('link'));
    }

    public function pin(Link $link): RedirectResponse
    {
        return redirect()->back();
    }

    public function markListAsRead(MarkListAsReadRequest $request): RedirectResponse
    {
        $payload = $request->validated();

        Link::query()
            ->whereIn('id', $payload['links'])
            ->update([
                'read_at' => now(),
            ]);

        return redirect()
            ->back()
            ->with('success', __('La liste a été modifiée.'));
    }

    public function search(Request $request)
    {
        $term = Str::squish(strip_tags($request->query('q', '')));

        $links = !empty($term)
            ? Link::search($term)
            : Link::query();

        $links = $links
            ->where('user_id', Auth::id())
            ->orderBy('published_at', 'desc')
            ->paginate(25);

        return view('pages.links.search-results', compact('links', 'term'));
    }
}
