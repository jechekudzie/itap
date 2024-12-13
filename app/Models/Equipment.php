<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Equipment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'equipment_category_id',
        'status',
        'serial_number',
        'asset_number',
        'image_path',
    ];

    // Add status constants
    const STATUS_AVAILABLE = 'available';
    const STATUS_IN_USE = 'in_use';
    const STATUS_MAINTENANCE = 'maintenance';
    const STATUS_RETIRED = 'retired';

    public static function getStatuses()
    {
        return [
            self::STATUS_AVAILABLE => 'Available',
            self::STATUS_IN_USE => 'In Use',
            self::STATUS_MAINTENANCE => 'Under Maintenance',
            self::STATUS_RETIRED => 'Retired'
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($equipment) {
            $equipment->slug = Str::slug($equipment->name);
            
            // Auto-generate asset number if not provided
            if (empty($equipment->asset_number)) {
                $equipment->asset_number = self::generateAssetNumber();
            }
        });

        static::updating(function ($equipment) {
            if ($equipment->isDirty('name')) {
                $equipment->slug = Str::slug($equipment->name);
            }
        });
    }

    public static function generateAssetNumber()
    {
        $prefix = 'EQ';
        $year = date('Y');
        
        // Get the last equipment number for this year
        $lastEquipment = self::where('asset_number', 'like', "{$prefix}{$year}%")
            ->orderBy('asset_number', 'desc')
            ->first();

        if ($lastEquipment) {
            // Extract the number and increment it
            $lastNumber = intval(substr($lastEquipment->asset_number, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format: EQ202400001
        return sprintf("%s%s%04d", $prefix, $year, $newNumber);
    }

    public function category()
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
    }

    public function specifications()
    {
        return $this->hasMany(EquipmentSpecification::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset($this->image_path);
        }
        return asset('images/default-equipment.png');
    }
}
