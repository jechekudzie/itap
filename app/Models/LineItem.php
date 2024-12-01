<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class LineItem extends Model
{
    use HasFactory,HasSlug;

    protected $guarded = [];

    public function LineItemCategory()
    {
        return $this->belongsTo(LineItemCategory::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)
            ->withPivot('quantity')
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
