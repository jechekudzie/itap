<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    //belong to booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    //belong to customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }



}
