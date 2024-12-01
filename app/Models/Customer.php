<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Customer extends Model
{
    use HasFactory,HasSlug;

    protected $guarded = [];


    //has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    //has many payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function customerIdentifications()
    {
        return $this->hasMany(CustomerIdentification::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // Add this method identificationType
    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name','last_name'])
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
