<?php

namespace App\Console\Commands\Feed;

use App\Jobs\FeedProcessor;
use App\Models\Feed;
use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:feed:refresh {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiser les abonnements';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $feeds = Feed::query()
            ->when($this->option('id'), fn ($query) => $query->where('id', (int) $this->option('id')))
            ->get();

        foreach ($feeds as $feed) {
            FeedProcessor::dispatch($feed);
        }
    }
}
