<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackageLineItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function servicePackage()
    {
        return $this->belongsTo(ServicePackage::class);
    }

    public function lineItem()
    {
        return $this->belongsTo(LineItem::class);
    }
}
