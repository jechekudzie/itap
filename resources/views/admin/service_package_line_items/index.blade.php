@extends('layouts.backend')

@section('title', 'Configure ' . $service->name . ' Packages')

@section('content')

        <div class="container-fluid">
            <!-- Breadcrumb -->
            <nav class="mb-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">CRM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $service->name }} Packages</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2>Configure {{ $service->name }} Packages</h2>
                <a href="{{ route('service-packages.index', $service->slug) }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left me-1"></i> Back
                </a>
            </div>

            <!-- Success and Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Please fix the following issues:
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Accordion for Line Items -->
            <div class="card shadow-sm border">
                <div class="card-body">
                    <form action="{{ route('service-packages.line-items.store', $servicePackage->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_package_id" value="{{ $servicePackage->id }}">

                        <div class="accordion" id="lineItemAccordion">
                            @foreach (\App\Models\LineItemCategory::with('lineItems')->get() as $index => $category)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $index }}">
                                            {{ $category->name }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                         aria-labelledby="heading{{ $index }}" data-bs-parent="#lineItemAccordion">
                                        <div class="accordion-body">
                                            <div class="row g-3">
                                                @foreach ($category->lineItems as $lineItem)
                                                    <div class="col-md-4">
                                                        <!-- Checkbox for Line Item -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="line_items[{{ $lineItem->id }}][checked]"
                                                                   id="line_item_{{ $lineItem->id }}"
                                                                   value="{{ $lineItem->id }}"
                                                                   @if ($servicePackage->packageLineItems->contains('line_item_id', $lineItem->id)) checked @endif>
                                                            <label class="form-check-label" for="line_item_{{ $lineItem->id }}">
                                                                {{ $lineItem->name }}
                                                            </label>
                                                        </div>

                                                        <!-- Quantity Input -->
                                                        <input type="number" name="line_items[{{ $lineItem->id }}][quantity]"
                                                               class="form-control form-control-sm mt-2"
                                                               placeholder="Qty" min="0" max="20"
                                                               value="{{ $servicePackage->packageLineItems->where('line_item_id', $lineItem->id)->first()->quantity ?? 0 }}"
                                                            {{ $lineItem->is_billable == 0 ? 'readonly style=background:#e9ecef;' : '' }}>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Form Footer -->
                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-light" onclick="history.back()">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Line Items</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Validate form before submission
            $('form').on('submit', function (e) {
                let isValid = true;

                // Validate checkboxes and associated quantities
                $('.form-check-input').each(function () {
                    const quantityInput = $(this).closest('.col-md-4').find('input[type="number"]');
                    const isBillable = quantityInput.attr('readonly') === undefined; // Check if input is not readonly
                    const isChecked = $(this).is(':checked');

                    if (isChecked) {
                        if (isBillable && (!quantityInput.val() || quantityInput.val() <= 0)) {
                            isValid = false;
                            quantityInput.addClass('is-invalid'); // Highlight invalid input
                        } else if (!isBillable && quantityInput.val() != 0) {
                            // Ensure non-billable items always have a quantity of 0
                            isValid = false;
                            quantityInput.addClass('is-invalid'); // Highlight invalid input
                        } else {
                            quantityInput.removeClass('is-invalid');
                        }
                    } else {
                        // Remove validation errors for unchecked items
                        quantityInput.removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please provide a valid quantity for all selected line items.');
                }
            });
        });
    </script>
@endpush
