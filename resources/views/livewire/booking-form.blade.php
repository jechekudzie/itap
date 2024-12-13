<div>
    {{-- The Master doesn't talk, he acts. --}}
    <style>
        .input-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .input-column {
            flex: 1;
            padding: 0 0.5rem;
            min-width: 250px; /* Adjust based on your design needs */
        }

        .input-column.full-width {
            flex-basis: 100%;
        }

        button {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

    </style>

    <form wire:submit.prevent="submitForm">
        @if ($currentStep == 1)
            <!-- Step 1: Personal Details -->
            <div class="input-row">
                <div class="input-column">
                    <select wire:model="title_id" class="form-control">
                        <option value="">Select Title</option>
                        @foreach (\App\Models\Title::all() as $title)
                            <option value="{{ $title->id }}">{{ $title->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-column">
                    <select wire:model="gender_id" class="form-control">
                        <option value="">Select Gender</option>
                        @foreach (\App\Models\Gender::all() as $gender)
                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="input-row">
                <div class="input-column">
                    <input type="text" wire:model="first_name" class="form-control" placeholder="First Name">
                </div>
                <div class="input-column">
                    <input type="text" wire:model="middle_name" class="form-control" placeholder="Middle Name (Optional)">
                </div>
            </div>
            <div class="input-row">
                <div class="input-column">
                    <input type="text" wire:model="last_name" class="form-control" placeholder="Last Name">
                </div>
                <div class="input-column">
                    <input type="date" wire:model="dob" class="form-control" placeholder="Date of Birth">
                </div>
            </div>
            <div class="input-row">
                <div class="input-column">
                    <select wire:model="identification_type_id" class="form-control">
                        <option value="">Select ID Type</option>
                        @foreach (\App\Models\IdentificationType::whereNotIn('id',[3])->get() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-column">
                    <input type="text" wire:model="identification" class="form-control" placeholder="Identification Number">
                </div>
            </div>
            <div class="input-row">
                <div class="input-column">
                    <select wire:model="country_id" class="form-control">
                        <option value="">Select Country</option>
                        @foreach (\App\Models\Country::all() as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="input-row">
                <div class="input-column full-width">
                    <button type="button" class="btn btn-danger w-70" wire:click="increaseStep">Next</button>
                </div>
            </div>

        @elseif ($currentStep == 2)
            <!-- Step 2: Service Details -->
            <input type="hidden" wire:model="service_package_id">
            <input type="hidden" wire:model="amount_invoiced">
            <input type="hidden" wire:model="additional_cost">

            <div class="input-row">
                <div class="input-column">
                    <input type="email" class="form-control" id="email" wire:model="email" placeholder="Enter your email">
                </div>
            </div>

            <div class="input-row">
                <div class="input-column">
                    <input type="tel" class="form-control" id="phone" wire:model="phone" placeholder="Enter your phone number">
                </div>
            </div>

            <div class="input-row">
                <div class="input-column">
                    <input type="text" class="form-control" id="address" wire:model="address" placeholder="Enter your physical address">
                </div>
            </div>

            <div class="input-row">
                <div class="input-column">
                    <input type="text" class="form-control" id="reservation_date" wire:model="reservation_date" placeholder="Choose Date">
                    <script>
                        flatpickr("#reservation_date", {
                            enableTime: true,
                            dateFormat: "Y-m-d H:i",
                            minDate: "today",
                            onChange: function(selectedDates, dateStr, instance) {
                            @this.set('reservation_date', dateStr);
                            },
                        });
                    </script>
                </div>
            </div>

            <div class="input-row">
                <div class="input-column full-width">
                    <button class="btn btn-danger w-70" type="button" wire:click="decreaseStep">Previous</button>
                    <button class="btn btn-danger w-70" type="button" wire:click="increaseStep">Next</button>
                </div>
            </div>

        @elseif ($currentStep == 3)
            <!-- Step 3: Payment Details -->
            <div class="input-row">
                <div class="input-column">
                    <select wire:model="payment_method_id" class="form-control">
                        <option value="">Select Payment Method</option>
                        @foreach (\App\Models\PaymentMethod::all() as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-column">
                    <input type="text" wire:model="payment_reference" class="form-control" placeholder="Payment Reference">
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="form-check-label" for="termsCheckbox">Agree to terms</label>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="termsCheckbox" wire:model="terms">
                        </div>
                    </div>
                </div>
            </div>


            <div class="input-row">
                <div class="input-column full-width">
                    <button class="btn btn-danger w-70" type="button" wire:click="decreaseStep">Previous</button>
                    <button class="btn btn-danger w-70" type="button" wire:click="submitForm">Sumbmit</button>
                </div>
            </div>
        @endif

    </form>
</div>
