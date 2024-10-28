<?php

namespace App\Console\Commands\Feed;

use App\Jobs\FeedProcessor;
use App\Models\Feed;
use App\Services\Feed\Contracts\FeedReaderInterface;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:feed:test {--url=} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tester les abonnements';

    /**
     * Execute the console command.
     */
    public function handle(FeedReaderInterface $reader)
    {
        if ($this->option('url')) {
            $result = $reader->links($this->option('url'));

            dd($result);
        }

        if ($this->option('id')) {
            $feed = Feed::find($this->option('id'));

            FeedProcessor::dispatchSync($feed);
        }
    }
}
