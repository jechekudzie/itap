<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Package extends Model
{
    use HasFactory,HasSlug;

    protected $guarded = [];


    public function packageCategory()
    {

        return $this->belongsTo(PackageCategory::class);
    }

    // Inside the Package model
    public function servicePackages()
    {
        return $this->hasMany(ServicePackage::class);
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

