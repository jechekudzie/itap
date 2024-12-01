@extends('layouts.backend')

@section('title', $service->name . ' Packages')

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
        <div class="d-flex align-items-center justify-content-start mb-4">
            <h2>{{ $service->name }} Packages</h2>
        </div>

        <div class="d-flex align-items-center justify-content-end mb-4">
            <a id="new-button" href="{{ route('service-packages.index', $service->slug) }}" class="btn btn-success me-3">
                <i class="fa fa-plus me-1"></i> Add New
            </a>
            <a href="{{ route('services.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left me-1"></i> Back
            </a>
        </div>
        <!-- Main Section -->
        <div class="row g-4">
            <!-- Packages Section -->
            <div class="col-lg-8">
                <div class="row g-3">
                    @foreach ($servicePackages->groupBy('packageCategory.name') as $categoryName => $packagesInCategory)
                        <!-- Category Title -->
                        <div class="col-12">
                            <h4 class="mb-4">{{ $categoryName }}</h4>
                        </div>

                        @foreach ($packagesInCategory as $servicePackage)
                            <div class="col-12 col-md-6">
                                <div class="card border shadow-sm h-100">
                                    <div class="card-body position-relative">
                                        <!-- Ribbon for Category -->
                                        <div class="position-absolute top-0 end-0">
                                            <span
                                                class="badge bg-danger text-white px-3 py-1">{{ $categoryName }}</span>
                                        </div>

                                        <!-- Discount Badge -->
                                        <div class="text-center">
                                            <div class="badge bg-light text-primary rounded-circle p-3 mb-3"
                                                 style="width: 60px; height: 60px; line-height: 30px;">
                                                {{ $servicePackage->on_discount ? $servicePackage->discount . '% off' : '0% off' }}
                                            </div>
                                        </div>

                                        <!-- Package Name -->
                                        <h5 class="text-center mb-3">{{ $servicePackage->package->name ?? 'Standard' }}</h5>

                                        <!-- Pricing Section -->
                                        <div class="text-center mb-3">
                                            @if ($servicePackage->on_discount)
                                                @php
                                                    $discountAmount = ($servicePackage->standard_price * $servicePackage->discount) / 100;
                                                    $discountedPrice = $servicePackage->standard_price - $discountAmount;
                                                @endphp
                                                <h6 class="text-muted text-decoration-line-through">
                                                    ${{ number_format($servicePackage->standard_price, 2) }}
                                                </h6>
                                                <h4 class="fw-bold text-primary">
                                                    ${{ number_format($discountedPrice, 2) }}
                                                </h4>
                                            @else
                                                <h4 class="fw-bold text-primary">
                                                    ${{ number_format($servicePackage->standard_price, 2) }}
                                                </h4>
                                            @endif
                                        </div>

                                        <!-- Features Section -->
                                        <hr>
                                        <div class="mb-3">
                                            @foreach ($lineItemCategories as $category)
                                                @php
                                                    $items = $servicePackage->packageLineItems->filter(function ($item) use ($category) {
                                                        return $item->lineItem && $item->lineItem->line_item_category_id == $category->id;
                                                    });
                                                @endphp

                                                @if ($items->isNotEmpty())
                                                    <h6 class="text-uppercase text-danger mb-2">{{ $category->name }}</h6>
                                                    <ul class="list-unstyled">
                                                        @foreach ($items as $item)
                                                            <li class="d-flex justify-content-between align-items-center">
                                                                <span>{{ $item->lineItem->name }}</span>
                                                                <span
                                                                    class="badge bg-primary">{{ $item->quantity }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endforeach
                                        </div>

                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('service-packages.line-items.create', $servicePackage->id) }}"
                                               class="btn btn-sm btn-success w-100 me-1">Configure</a>
                                            <button type="button" class="btn btn-sm btn-primary w-100 me-1 edit-button"
                                                    data-id="{{ $servicePackage->id }}"
                                                    data-name="{{ $servicePackage->package->name }}"
                                                    data-description="{{ $servicePackage->description }}"
                                                    data-standard-price="{{ $servicePackage->standard_price }}"
                                                    data-on-discount="{{ $servicePackage->on_discount }}"
                                                    data-discount="{{ $servicePackage->discount }}"
                                                    data-service-id="{{ $service->id }}"
                                                    data-service-slug="{{ $service->slug }}"
                                                    data-package-id="{{ $servicePackage->package_id }}"
                                                    data-package-category-id="{{ $servicePackage->package_category_id }}">
                                                Edit
                                            </button>

                                            <form
                                                action="{{ route('service-packages.destroy', [$service->slug, $servicePackage->id]) }}"
                                                method="POST" onsubmit="return confirm('Are you sure?');"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger w-100">Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <!-- Form Section -->
            <div class="col-lg-4">
                <div class="card shadow-sm border">
                    <div class="card-header bg-light">
                        <h6 id="card-title">Add Service Package</h6>
                    </div>
                    <div class="card-body">
                        <form id="edit-form" action="{{ route('service-packages.store', $service->slug) }}"
                              method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="service_id" id="service_id" value="{{ $service->id }}">

                            <!-- Package Type -->
                            <div class="mb-3">
                                <label for="package_category_id" class="form-label">Package Type</label>
                                <select name="package_category_id" id="package_category_id" class="form-select">
                                    <option value="">Select Package Type</option>
                                    @foreach (\App\Models\PackageCategory::all() as $packageCategory)
                                        <option value="{{ $packageCategory->id }}">{{ $packageCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Package -->
                            <div class="mb-3">
                                <label for="package_id" class="form-label">Package</label>
                                <select name="package_id" id="package_id" class="form-select">
                                    <option value="">Select Package</option>
                                    @foreach (\App\Models\Package::all() as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Standard Price -->
                            <div class="mb-3">
                                <label for="standard_price" class="form-label">Standard Price</label>
                                <input type="number" name="standard_price" class="form-control" id="standard_price"
                                       placeholder="Enter price">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description"
                                          placeholder="Enter description"></textarea>
                            </div>

                            <!-- On Discount Checkbox -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="on_discount" class="form-check-input" id="on_discount"
                                       value="1">
                                <label class="form-check-label" for="on_discount">On Discount</label>
                            </div>
                            <input type="hidden" name="on_discount" value="0">

                            <!-- Discount Field -->
                            <div class="mb-3" id="discount-field" style="display: none;">
                                <label for="discount" class="form-label">Discount (%)</label>
                                <div class="input-group">
                                    <input type="number" name="discount" class="form-control" id="discount"
                                           placeholder="Enter discount percentage" value="" min="0" max="100"
                                           step="0.01">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div id="discountHelp" class="form-text">Enter a value between 0 and 100.</div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100" id="submit-button">Add New</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        $(document).ready(function () {
            const discountField = $('#discount-field'); // Discount percentage field
            const onDiscountCheckbox = $('#on_discount'); // Discount checkbox

            // Toggle Discount Field Visibility
            onDiscountCheckbox.change(function () {
                if (this.checked) {
                    discountField.show(); // Show discount field when checked
                    $('input[type="hidden"][name="on_discount"]').prop('disabled', true);
                } else {
                    discountField.hide(); // Hide discount field when unchecked
                    $('#discount').val(''); // Clear discount value
                    $('input[type="hidden"][name="on_discount"]').prop('disabled', false);
                }
            });

            // Trigger change on page load in case checkbox is pre-checked
            onDiscountCheckbox.trigger('change');

            // Edit Button Click Handler
            $('.edit-button').on('click', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');
                const standardPrice = $(this).data('standard-price');
                const onDiscount = $(this).data('on-discount');
                const discount = $(this).data('discount');
                const serviceSlug = $(this).data('service-slug');
                const packageId = $(this).data('package-id');
                const packageCategoryId = $(this).data('package-category-id');

                // Set form action for update
                $('#edit-form').attr('action', '/admin/service-package/' + serviceSlug + '/' + id + '/update');
                $('input[name="_method"]').val('PATCH');

                // Update Form Title and Button
                $('#card-title').text('Edit - ' + name + ' Service Package');
                $('#submit-button').text('Update');

                // Populate Form Fields
                $('#package_category_id').val(packageCategoryId);
                $('#package_id').val(packageId);
                $('#standard_price').val(standardPrice);
                $('#description').val(description);

                // Handle Discount Checkbox
                onDiscountCheckbox.prop('checked', onDiscount == 1);
                if (onDiscount == 1) {
                    discountField.show();
                    $('#discount').val(discount);
                } else {
                    discountField.hide();
                    $('#discount').val('');
                }

                // Scroll to form section
                $('html, body').animate({
                    scrollTop: $('#edit-form').offset().top - 20
                }, 500);
            });

            // New Button Click Handler
            $('#new-button').on('click', function () {
                // Reset form for adding a new package
                $('#edit-form').attr('action', '/admin/service-package/store');
                $('input[name="_method"]').val('POST');

                // Reset Form Title and Button
                $('#card-title').text('Add Service Package');
                $('#submit-button').text('Add New');

                // Clear Form Fields
                $('#package_category_id').val('');
                $('#package_id').val('');
                $('#standard_price').val('');
                $('#description').val('');
                onDiscountCheckbox.prop('checked', false);
                discountField.hide();
                $('#discount').val('');

                // Scroll to form section
                $('html, body').animate({
                    scrollTop: $('#edit-form').offset().top - 20
                }, 500);
            });
        });
    </script>

@endsection
