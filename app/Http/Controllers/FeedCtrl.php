<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feed\StoreRequest;
use App\Http\Requests\Feed\UpdateRequest;
use App\Jobs\FeedProcessor;
use App\Models\Feed;
use App\Models\Link;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FeedCtrl extends Controller
{
    public function index(): View
    {
        $feeds = Feed::query()
            ->whereUser(Auth::user())
            ->paginate(15);

        return view(
            view: 'pages.feeds.index',
            data: compact('feeds')
        );
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $payload = $request->validated();

            $feed = Feed::create($payload);

            FeedProcessor::dispatch($feed);

            $feed->save();

            return redirect()
                ->route('feeds.index')
                ->with('success', __('Vous venez de souscrire à :feed', [
                    'feed' => $feed->name,
                ]));
        } catch (\Throwable $th) {
            return redirect()
                ->route('feeds.index')
                ->with('error', __("Nous ne pouvons pas s'abonner à ce site, vérifiez que le lien est toujours valide !"));
        }
    }

    public function edit(Feed $feed): View
    {
        abort_if(
            $feed->user_id != Auth::id(),
            Response::HTTP_FORBIDDEN,
            __("Ce lien n'est pas disponible.")
        );

        $feed->load('user');

        return view(
            view: 'pages.feeds.edit',
            data: compact('feed')
        );
    }

    public function update(UpdateRequest $request, Feed $feed): RedirectResponse
    {
        abort_if(
            $feed->user_id != Auth::id(),
            Response::HTTP_FORBIDDEN,
            __("Ce lien n'est pas disponible.")
        );

        $payload = $request->validated();

        $feed->update($payload);

        return redirect()->route('feeds.index');
    }

    public function destroy(Feed $feed): RedirectResponse
    {
        abort_if(
            $feed->user_id != Auth::id(),
            Response::HTTP_FORBIDDEN,
            __("Ce lien n'est pas disponible.")
        );

        Link::query()
            ->where('feed_id', $feed->id)
            ->delete();

        $feed->delete();

        return redirect()
            ->route('feeds.index')
            ->with('success', __(':feed a été supprimé !', [
                'feed' => $feed->name,
            ]));
    }

    public function refresh(Feed $feed)
    {
        abort_if(
            $feed->user_id != Auth::id(),
            Response::HTTP_FORBIDDEN,
            __("Ce lien n'est pas disponible.")
        );

        $feed = Feed::query()
            ->with('user')
            ->find($feed->id);

        FeedProcessor::dispatch($feed);

        $feed->save();

        return back()->with(
            'success',
            __(':feed sera actualisé dans un instant', [
                'feed' => $feed->name,
            ])
        );
    }

    public function show(Feed $feed): View
    {
        abort_if(
            $feed->user_id != Auth::id(),
            Response::HTTP_FORBIDDEN,
            __("Ce lien n'est pas disponible.")
        );

        $links = Link::query()
            ->where('user_id', Auth::id())
            ->where('feed_id', '=', $feed->id)
            ->paginate(25);

        return view(
            view: 'pages.feeds.links',
            data: compact('links', 'feed')
        );
    }
}
