<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'text',
        'original_content',
        'external_url',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function isTweet(): bool
    {
        return $this->getType() === 'tweet';
    }

    public function getType(): string
    {
        if ($this->hasTag('tweet')) {
            return 'tweet';
        }

        if ($this->original_content) {
            return 'original';
        }

        return 'link';
    }

    public function hasTag(string $tagName): bool
    {
        return $this->tags->contains(fn (Tag $tag) => $tag->name === $tagName);
    }
}
