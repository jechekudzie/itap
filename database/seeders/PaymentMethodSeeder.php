<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //payment methods
        $paymentMethods = [
            ['name' => 'Cash USD', 'description' => 'Payment made in cash or cash on delivery'],
            ['name' => 'Bank Transfer USD', 'description' => 'Payment made via bank transfer for USD'],
            ['name' => 'Bank Transfer ZIG', 'description' => 'Payment made via bank transfer for ZIG'],
            ['name' => 'Paynow', 'description' => 'Payment made via Online'],
            ['name' => 'O-Mari', 'description' => 'Payment made via Online O-Mari'],
            ['name' => 'Ecocash USD', 'description' => 'Payment made via mobile money'],
            ['name' => 'Ecocash ZIG', 'description' => 'Payment made via mobile money'],
            ['name' => 'Zipit USD', 'description' => 'Payment made via Zipit USD'],
            ['name' => 'Zipit ZIG', 'description' => 'Payment made via Zipit ZIG'],
            ['name' => 'POS Swipe', 'description' => 'Payment made via Point of Sale machine'],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            \App\Models\PaymentMethod::create($paymentMethod);
        }
    }
}
