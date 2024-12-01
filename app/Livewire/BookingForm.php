<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\ServicePackage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class BookingForm extends Component
{
    public $currentStep = 1;
    public $title_id, $gender_id, $first_name = '', $middle_name, $last_name, $dob, $identification_type_id, $identification, $country_id;
    public $customer_id, $service_category_id, $service_id, $service_package_id, $organisation_id, $amount_invoiced, $additional_cost, $terms = false;
    public $reservation_date, $reservation_time, $reservation_note, $is_confirmed = false;
    public $email, $phone, $address, $city, $state, $zip_code, $country;
    public $payment_reference, $payment_method, $payment_status, $payment_amount, $payment_date;

    public $servicePackageId;
    public $servicePackage;

    public function mount($servicePackageId, $servicePackage)
    {

       // dd($servicePackageId, $servicePackage);
        $this->servicePackageId = $servicePackageId;
        $this->servicePackage = $servicePackage;
        if ($servicePackage) {
            $this->service_package_id = $servicePackage->id;
            $this->service_id = $servicePackage->service->id;
            $this->service_category_id = $servicePackage->service->serviceCategory->id;
        }

        //check if servicePackage is on discount
        if ($this->servicePackage->on_discount == 1) {
         //amount invoiced is the standard price minus the discount %
            $discount = $this->servicePackage->discount / 100;
            $discountedAmount = $this->servicePackage->standard_price * $discount;

            $this->amount_invoiced = $this->servicePackage->standard_price - $discountedAmount;
        }else{
            $this->amount_invoiced = $this->servicePackage->standard_price;
        }

    }

    public function render()
    {
        return view('livewire.booking-form');
    }

    public function increaseStep()
    {

        $this->currentStep++;
    }

    public function decreaseStep()
    {
        $this->currentStep--;
    }

    public function submitForm()
    {
        // Validate and process the form data here
        $this->validateData();

        // Check if a user with the same email exists
        $existingUser = User::where('email', $this->email)->first();

        if ($existingUser) {
            // User exists, update information
            $existingUser->update([
                // Update user fields as needed
                'email' => $this->email,
                'name' => $this->first_name . ' ' . $this->last_name,
            ]);
        } else {
            // User doesn't exist, create a new user
            $user = User::create([
                'email' => $this->email,
                'name' => $this->first_name . ' ' . $this->last_name,
                'password' => Hash::make('password@1'),
            ]);
        }

        // Check if a customer with the same phone or email or both exists
        $existingCustomer = Customer::where('phone', $this->phone)
            ->orWhere('email', $this->email)
            ->first();

        if ($existingCustomer) {
            // Customer exists, update information
            $existingCustomer->update([
                // Update customer fields as needed
                'user_id' => isset($user) ? $user->id : $existingCustomer->user_id,
                'phone' => $this->phone,
                'email' => $this->email,
                'title_id' => $this->title_id,
                'gender_id' => $this->gender_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'dob' => $this->dob,
                'identification_type_id' => $this->identification_type_id,
                'identification' => $this->identification,
                'country_id' => $this->country_id,

            ]);
        } else {
            // Customer doesn't exist, create a new customer
            $customer = Customer::create([
                'user_id' => isset($user) ? $user->id : null,
                'phone' => $this->phone,
                'email' => $this->email,
                'title_id' => $this->title_id,
                'gender_id' => $this->gender_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'dob' => $this->dob,
                'identification_type_id' => $this->identification_type_id,
                'identification' => $this->identification,
                'country_id' => $this->country_id,
            ]);
        }

        // Create a new booking
        $booking = Booking::create([
            'customer_id' => isset($customer) ? $customer->id : $existingCustomer->id,
            'service_category_id' => $this->service_category_id,
            'service_id' => $this->service_id,
            'service_package_id' => $this->service_package_id,
            'organisation_id' => $this->organisation_id,
            'amount_invoiced' => $this->amount_invoiced,
            'additional_cost' => $this->additional_cost,
            'terms' => $this->terms,
            'is_confirmed' => $this->is_confirmed,
        ]);


        // redirect back to the booking form
        return redirect()->route('booking-form', $this->servicePackageId);
    }


    private function validateData()
    {
        // Add validation logic for each step here, depending on $this->currentStep
    }
}
