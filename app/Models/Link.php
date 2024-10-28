<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class Link extends Model
{
    use HasFactory;
    // use Searchable;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'feed_id',
        'reference',
        'title',
        'content',
        'url',
        'published_at',
        'read_at',
        'tags',
        'image',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'read_at' => 'datetime',
        'pinned_at' => 'datetime',
    ];

    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_link');
    }

    public function isPinned(): Attribute
    {
        return Attribute::make(
            get: function () {
                return !empty($this->pinned_at);
            }
        );
    }

    public function scopeWhereUser(Builder $query, int|User $user)
    {
        return $query->where('user_id', $user instanceof User ? $user->id : $user);
    }

    public function scopeWherePinned(Builder $query)
    {
        return $query->whereNotNull('pinned_at');
    }

    public function scopeSearch(Builder $query, string $term = '')
    {
        return $query
            ->where('url', 'like', '%' . $term . '%')
            ->orWhere('title', 'like', '%' . $term . '%');
    }

    /**
     * Content.
     *
     * @see https://packagist.org/packages/symfony/html-sanitizer
     *
     * @return Attribute
     */
    public function content(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) {
                    return '';
                }

                $config = (new HtmlSanitizerConfig())
                    ->allowSafeElements()
                    ->allowStaticElements()
                    ->allowElement('div')
                    ->allowElement('a', 'href')
                    ->allowElement('img', ['src', 'alt'])
                    ->allowElement('iframe', ['src'])
                    ->forceAttribute('a', 'rel', 'noopener noreferrer')
                    ->forceAttribute('img', 'class', 'd-block mx-auto my-3')
                    ->allowLinkSchemes(['https', 'http', 'mailto'])
                    ->allowRelativeLinks()
                    ->allowMediaSchemes(['https', 'http'])
                    // ->allowMediaHosts(['youtube.com'])
                    ->allowRelativeMedias();

                $sanitizer = new HtmlSanitizer($config);

                return $sanitizer->sanitize($value);
            }
        );
    }

    public function searchableAs(): string
    {
        return 'piou_links';
    }

    #[SearchUsingPrefix(['id'])]
    #[SearchUsingFullText(['content', 'title'])]
    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with('feed');
    }
}
