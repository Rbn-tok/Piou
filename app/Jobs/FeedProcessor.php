<?php

namespace App\Jobs;

use App\Models\Feed;
use App\Models\Link;
use App\Services\Feed\Contracts\FeedReaderInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FeedProcessor implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Feed $feed)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(FeedReaderInterface $reader): void
    {
        $links = $reader->links($this->feed->url);

        foreach ($links as $link) {
            Link::updateOrCreate(
                [
                    'reference' => $link->getId(),
                    'user_id' => $this->feed->user->id,
                    'feed_id' => $this->feed->id,
                ],
                [
                    'title' => $link->getTitle(),
                    'content' => $link->getContent(),
                    'url' => $link->getUrl(),
                    'published_at' => $link->getPublishedAt(),
                    'thumbnail' => $link->getImage() ?? '',
                ]
            );
        }
        $this->feed->checked_at = now();
        $this->feed->save();
    }
}
