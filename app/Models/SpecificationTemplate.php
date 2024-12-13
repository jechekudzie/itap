<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SpecificationTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'field_type',
        'is_required',
        'allow_multiple',
        'default_value',
        'options',
        'validation_rules',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'allow_multiple' => 'boolean',
        'options' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($template) {
            $template->slug = Str::slug($template->name);
        });

        static::updating(function ($template) {
            if ($template->isDirty('name')) {
                $template->slug = Str::slug($template->name);
            }
        });
    }

    public function equipmentCategory()
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
} 