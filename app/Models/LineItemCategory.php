<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class LineItemCategory extends Model
{
    use HasFactory,HasSlug;

    protected $guarded = [];

    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
