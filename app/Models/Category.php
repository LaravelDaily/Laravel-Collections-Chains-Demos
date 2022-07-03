<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function slugs()
    {
        return $this->hasMany(Slug::class);
    }

    public function getSlug($locale = null)
    {
        if (($slug = $this->getActiveSlug($locale)) != null) {
            return $slug->slug;
        }

        if (config('translatable.use_property_fallback', false) && (($slug = $this->getFallbackActiveSlug()) != null)) {
            return $slug->slug;
        }

        return "";
    }

    public function getActiveSlug($locale = null)
    {
        return $this->slugs->first(function ($slug) use ($locale) {
                return ($slug->locale === ($locale ?? app()->getLocale())) && $slug->active;
            }) ?? null;
    }

    public function getFallbackActiveSlug()
    {
        return $this->slugs->first(function ($slug) {
                return $slug->locale === config('translatable.fallback_locale') && $slug->active;
            }) ?? null;
    }
}
