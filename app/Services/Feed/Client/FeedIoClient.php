<?php

namespace App\Services\Feed\Client;

use App\Models\Feed;
use App\Services\Feed\Contracts\FeedReaderInterface;
use App\Services\Feed\Entities\Link;
use FeedIo\Adapter\Http\Client as HttpClient;
use FeedIo\FeedIo;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class FeedIoClient implements FeedReaderInterface
{
    protected $client;

    public function __construct()
    {
        $client = new HttpClient(new Client());

        $logger = new Logger(
            'default',
            [new StreamHandler('php://stdout')]
        );

        $this->client = new FeedIo($client, $logger);
    }

    public function discover(string $feed): Collection
    {
        return collect();
    }

    public function links(string $feed): Collection
    {
        $result = $this
            ->getClient()
            ->read($feed);

        $links = collect();

        foreach ($result->getFeed() as $entry) {
            $link = (new Link())
                ->setId($entry->getLink())
                ->setTitle($entry->getTitle())
                ->setUrl($entry->getLink())
                ->setPublishedAt($entry->getLastModified()->format('Y-m-d H:i:s'))
                ->setContent($entry->getContent());

            if ($entry->hasMedia()) {
                $medias = $entry->getMedias();
                foreach ($medias as $media) {
                    $link->setImage($media->getUrl());

                    break;
                }
            }

            $links->push($link);
        }

        return $links;
    }

    public function about(string $feed): Model
    {
        try {
            $result = $this
                ->getClient()
                ->read($feed);
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getTrace());
        }

        $feed = $result->getFeed();

        return new Feed([
            'name' => $feed->getTitle(),
            'url' => $feed->getLink(),
            'favicon' => '',
        ]);
    }

    public function getClient(): FeedIo
    {
        return $this->client;
    }
}
