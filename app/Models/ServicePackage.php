<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ServicePackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define relationships

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // If you have a PackageCategory model
    public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class);
    }

    public function packageLineItems()
    {
        return $this->hasMany(ServicePackageLineItem::class);
    }

    public function calculateTotalCost()
    {
        return $this->packageLineItems->reduce(function ($total, $packageLineItem) {
            return $total + ($packageLineItem->quantity * $packageLineItem->price);
        }, 0);
    }


}
