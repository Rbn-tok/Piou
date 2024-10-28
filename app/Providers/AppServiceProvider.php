<?php

namespace App\Providers;

use App\Services\Feed\Client\FeedIoClient;
use App\Services\Feed\Client\FeedReader;
use App\Services\Feed\Contracts\FeedReaderInterface;
use App\Services\Link\Client\ContentKeywords;
use App\Services\Link\Contracts\ContentKeywordsInterface;
use App\Services\Pocket\Client\PocketAuthenticateService;
use App\Services\Pocket\Client\PocketService;
use App\Services\Pocket\Contracts\PocketAuthenticateInterface;
use App\Services\Pocket\Contracts\PocketInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FeedReaderInterface::class, FeedReader::class);
        // $this->app->singleton(FeedReaderInterface::class, FeedIoClient::class);
        $this->app->singleton(ContentKeywordsInterface::class, ContentKeywords::class);
        $this->app->singleton(PocketAuthenticateInterface::class, PocketAuthenticateService::class);
        $this->app->singleton(PocketInterface::class, PocketService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Blade::if('isRoute', function (string $value) {
            $routes = array_map('trim', explode(',', $value));

            $status = in_array(Route::currentRouteName(), $routes);

            if (!$status) {
                $status = str_starts_with(Route::currentRouteName(), $value);

                if (!$status) {
                    foreach ($routes as $route) {
                        $status = str_starts_with(Route::currentRouteName(), $route);

                        if ($status) {
                            break;
                        }
                    }
                }
            }

            return $status;
        });
    }
}
