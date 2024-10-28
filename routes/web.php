<?php

use App\Http\Controllers\FeedCtrl;
use App\Http\Controllers\LinkCtrl;
use App\Http\Controllers\PocketCtrl;
use App\Http\Controllers\UserCtrl;
use App\Livewire\Bookmarks\BookmarkList;
use App\Livewire\Feed\Links;
use App\Livewire\Link\Show;
use App\Livewire\Link\TodayList;
use App\Livewire\Link\WeekList;
use App\Livewire\Link\YesterdayList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [UserCtrl::class, 'login'])
    ->middleware(['guest'])
    ->name('login');

Route::post('login', [UserCtrl::class, 'authenticate'])
    ->middleware(['guest']);

Route::post('logout', [UserCtrl::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout');

Route::get('feeds', [FeedCtrl::class, 'index'])
    ->middleware(['auth'])
    ->name('feeds.index');

Route::post('feeds', [FeedCtrl::class, 'store'])
    ->middleware(['auth'])
    ->name('feeds.store');

Route::post('feeds/{feed}', [FeedCtrl::class, 'refresh'])
    ->middleware(['auth'])
    ->name('feeds.sync');

Route::get('feeds/{feed}/edit', [FeedCtrl::class, 'edit'])
    ->middleware(['auth'])
    ->name('feeds.edit');

Route::put('feeds/{feed}', [FeedCtrl::class, 'update'])
    ->middleware(['auth'])
    ->name('feeds.update');

Route::delete('feeds/{feed}', [FeedCtrl::class, 'destroy'])
    ->middleware(['auth'])
    ->name('feeds.delete');

Route::get('feeds/{feed}', Links::class)
    ->middleware(['auth'])
    ->name('feeds.show');

Route::get('pocket-auth', [PocketCtrl::class, 'authenticate'])
    ->middleware(['auth'])
    ->name('pocket.auth');

Route::get('pocket-auth-callback', [PocketCtrl::class, 'callback'])
    ->middleware(['auth'])
    ->name('pocket.callback');

Route::get('pocket-add/{link}', [PocketCtrl::class, 'addArticle'])
    ->middleware(['auth'])
    ->name('pocket.add');

Route::put('links/{link}', [LinkCtrl::class, 'pin'])
    ->middleware(['auth'])
    ->name('links.pin');

Route::patch('links', [LinkCtrl::class, 'markListAsRead'])
    ->middleware(['auth'])
    ->name('links.mark-list-as-read');

Route::get('search', [LinkCtrl::class, 'search'])
    ->name('search.index')
    ->middleware(['auth']);

Route::get('/', TodayList::class)
    ->middleware(['auth'])
    ->name('home');

Route::get('yesterday', YesterdayList::class)
    ->middleware(['auth'])
    ->name('yesterday');

Route::get('week', WeekList::class)
    ->middleware(['auth'])
    ->name('week');

Route::get('links/{link}', Show::class)
    ->middleware(['auth'])
    ->name('links.show');

Route::get('bookmarks', BookmarkList::class)
    ->middleware(['auth'])
    ->name('bookmarks.index');
