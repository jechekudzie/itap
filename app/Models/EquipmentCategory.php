<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EquipmentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    // Boot method to automatically generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (!$category->slug) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Use slug for route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Automatically update slug when name changes
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function specificationTemplates()
    {
        return $this->hasMany(SpecificationTemplate::class);
    }
}