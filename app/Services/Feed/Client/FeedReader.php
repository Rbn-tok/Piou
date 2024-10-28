<?php

namespace App\Services\Feed\Client;

use App\Models\Feed;
use App\Services\Feed\Contracts\FeedReaderInterface;
use App\Services\Feed\Entities\Link;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laminas\Feed\Reader\Reader;

class FeedReader implements FeedReaderInterface
{
    public function __construct()
    {
        Reader::setHttpClient(new HttpRequest());
    }

    public function discover(string $feed): Collection
    {
        return collect();
    }

    public function links(string $feed): Collection
    {
        $entries = Reader::import($feed);

        $links = collect();

        foreach ($entries as $entry) {
            $link = (new Link())
                ->setId($entry->getId())
                ->setTitle($entry->getTitle())
                ->setUrl($entry->getLink())
                ->setPublishedAt($entry->getDateModified()->format('Y-m-d H:i:s'))
                ->setContent($entry->getContent())
                ->setImage($entry->getEnclosure(0));

            $links->push($link);
        }

        return $links;
    }

    public function about(string $feed): Model
    {
        $response = Reader::import($feed);

        return new Feed([
            'name' => $response->getTitle(),
            'url' => $response->getFeedLink(),
            'favicon' => '',
        ]);
    }
}
