<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentSpecification extends Model
{
    protected $fillable = [
        'equipment_id',
        'specification_template_id',
        'value', // Stores the actual value (can be JSON for multiple values)
    ];

    protected $casts = [
        'value' => 'json', // Automatically handle JSON encoding/decoding
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function template()
    {
        return $this->belongsTo(SpecificationTemplate::class, 'specification_template_id');
    }
} 