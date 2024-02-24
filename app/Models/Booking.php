<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    //belongs to customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }



}
