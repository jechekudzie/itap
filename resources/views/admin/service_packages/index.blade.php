@extends('layouts.admin')

@push('head')

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <style>
        .custom-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .custom-card .card-body {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-content {
            flex-grow: 1; /* This makes sure that card content can grow */
            overflow: auto; /* In case the content is too much, it will be scrollable */
        }


    </style>
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0" id="page-title">{{$service->name}} Packages</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">>{{$service->name}} Packages</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <div class="flex-grow-1">

                                        <a href="{{route('services.index')}}" class="btn btn-info btn-sm add-btn">
                                            <i class="fa fa-arrow-left"></i> Back
                                        </a>
                                        <a href="{{route('service-packages.index',$service->slug)}}" id="new-button"
                                           class="btn btn-success btn-sm add-btn">
                                            <i class="fa fa-plus"></i> Add new
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-9">
                        @if(session()->has('errors'))
                            @if($errors->any())

                                @foreach($errors->all() as $error)
                                    <!-- Success Alert -->
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong> Errors! </strong> {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endforeach

                            @endif
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Message!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="cards-container">
                            <div class="card">

                                @foreach($servicePackages->groupBy('packageCategory.name') as $categoryName => $packagesInCategory)
                                    <!-- Category Section -->
                                    <div class="category-section mb-4">
                                        <div class="card-header d-flex justify-content-center align-items-center">
                                            <h3 class="category-name m-0">{{ $categoryName }}</h3>
                                        </div>

                                        <div class="row">

                                            @foreach($packagesInCategory as $servicePackage)

                                                <div class="col-xxl-4 col-lg-4 col-md-6">
                                                    <div class="card pricing-box ribbon-box right custom-card">
                                                        <div class="card-body p-4 m-2">
                                                            <!-- Card Content -->
                                                            <div class="ribbon-two ribbon-two-danger">
                                                                <span>{{ $servicePackage->packageCategory->name }}</span>
                                                            </div>

                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="mb-1 fw-semibold">{{ $servicePackage->package->name ?? 'N/A' }}</h5>
                                                                </div>
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-light rounded-circle text-primary d-flex justify-content-center align-items-center"
                                                                        style="width: 60px; height: 60px;">
                                                                        @if($servicePackage->on_discount)
                                                                            @php
                                                                                $discountPercentage = $servicePackage->discount;
                                                                            @endphp
                                                                            <span style="font-size: 14px;">{{ round($discountPercentage) }}% off</span>
                                                                        @else
                                                                            <span style="font-size: 14px;">0% off</span>
                                                                            <!-- You can replace this with any default text or icon -->
                                                                        @endif
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="pt-4">
                                                                <h2>
                                                                    <div class="price-section">
                                                                        @if($servicePackage->on_discount)
                                                                            @php
                                                                                // Calculate discounted price
                                                                                $discountAmount = ($servicePackage->standard_price * $servicePackage->discount) / 100;
                                                                                $discountedPrice = $servicePackage->standard_price - $discountAmount;
                                                                            @endphp

                                                                                <!-- Display standard price with strikethrough -->
                                                                            <span class="original-price" style="text-decoration: line-through;">
                                                                                <sup>$</sup>{{ number_format($servicePackage->standard_price, 2) }}
                                                                            </span>
                                                                            <!-- Space between prices -->
                                                                            &nbsp;
                                                                            <!-- Display discounted price -->
                                                                            <span class="discounted-price">
                                                                                <sup>$</sup>{{ number_format($discountedPrice, 2) }}
                                                                            </span>
                                                                        @else
                                                                            <!-- Display standard price without discount -->
                                                                            <span class="standard-price">
                                                                                <sup>$</sup>{{ number_format($servicePackage->standard_price, 2) }}
                                                                            </span>
                                                                        @endif
                                                                    </div>

                                                                    <span class="fs-13 text-muted"></span>
                                                                </h2>
                                                            </div>

                                                            <hr class="my-4 text-muted">

                                                            <div class="card-content">
                                                                <!-- Line Items Content -->
                                                                @foreach($lineItemCategories as $category)
                                                                    @php
                                                                        // Filter packageLineItems for the current category
                                                                        $items = $servicePackage->packageLineItems->filter(function ($item) use ($category) {
                                                                            return $item->lineItem && $item->lineItem->line_item_category_id == $category->id;
                                                                        });
                                                                    @endphp

                                                                    @if($items->isNotEmpty())
                                                                        <h6 class="text-uppercase text-danger font-bold">{{ $category->name }}</h6>
                                                                        <ul class="list-unstyled vstack gap-3 text-muted">
                                                                            @foreach($items as $item)
                                                                                <li class="d-flex justify-content-between align-items-center text-black">
                                                                                    {{ $item->lineItem->name ?? 'N/A' }}
                                                                                    @if($item->quantity > 0)
                                                                                        <span class="badge bg-primary rounded-pill">{{ $item->quantity }}</span>
                                                                                    @else
                                                                                        {{ '' }}
                                                                                    @endif
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                @endforeach


                                                            </div>

                                                            <!-- Buttons (Configure, Edit, Delete) -->
                                                            <div class="mt-4">
                                                                <a href="{{ route('service-packages.line-items.create', $servicePackage->id) }}"
                                                                   class="btn btn-sm btn-success w-100 waves-effect waves-light">Configure</a>
                                                            </div>
                                                            <div class="mt-4">
                                                                <!-- Edit Button -->
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm btn-primary edit-button w-100 waves-effect waves-light"
                                                                   title="Edit"
                                                                   data-id="{{ $servicePackage->id }}"
                                                                   data-name="{{ $servicePackage->package->name }}"
                                                                   data-description="{{ $servicePackage->description }}"
                                                                   data-standard-price="{{ $servicePackage->standard_price }}"
                                                                   data-on-discount="{{ $servicePackage->on_discount }}"
                                                                   data-discount="{{ $servicePackage->discount }}"
                                                                   data-service-id="{{ $servicePackage->service_id }}"
                                                                   data-service-slug="{{ $servicePackage->service->slug }}"
                                                                   data-package-id="{{ $servicePackage->package_id }}"
                                                                   data-package-category-id="{{ $servicePackage->package_category_id }}">
                                                                    <i class="fa fa-pencil"></i> Edit
                                                                </a>
                                                            </div>
                                                            <div class="mt-4">
                                                                <!-- Edit Button -->
                                                                <form
                                                                    action="{{ route('service-packages.destroy', [$service->slug,$servicePackage->id])}}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure?');"
                                                                    style="display: inline-block;"
                                                                    class="w-100">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            class="btn btn-sm btn-danger w-100 waves-effect waves-light"
                                                                            title="Delete">
                                                                        <i class="fa fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach


                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                    <!--end col-->
                    <div class="col-xxl-3">
                        <div class="card border card-border-light">
                            <div class="card-header">
                                <h6 id="card-title" class="card-title mb-0">Add {{$service->name}} Package</h6>
                            </div>
                            <div class="card-body">
                                <form id="edit-form" action="{{ route('service-packages.store', $service->slug)}}"
                                      method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="POST">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                                    <!-- Package Category Dropdown -->
                                    <div class="mb-3">
                                        <label for="package_category_id" class="form-label">Package Type</label>
                                        <select name="package_category_id" id="package_category_id" class="form-select">
                                            <option value="">Select Package Type</option>
                                            @foreach(\App\Models\PackageCategory::all() as $packageCategory)
                                                <option
                                                    value="{{ $packageCategory->id }}">{{ $packageCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Package Dropdown -->
                                    <div class="mb-3">
                                        <label for="package_id" class="form-label">Package</label>
                                        <select name="package_id" id="package_id" class="form-select">
                                            <option value="">Select Package</option>
                                            @foreach(\App\Models\Package::all() as $package)
                                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <!-- Standard Price -->
                                    <div class="mb-3">
                                        <label for="standard_price" class="form-label">Standard Price</label>
                                        <input type="text" name="standard_price" class="form-control"
                                               id="standard_price" placeholder="Enter standard price" value="">
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" id="description"
                                                  placeholder="Enter description"></textarea>
                                    </div>

                                    <!-- On Discount Checkbox -->
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" name="on_discount" class="form-check-input"
                                               id="on_discount" value="1">
                                        <label class="form-check-label" for="on_discount">On Discount</label>
                                    </div>
                                    <input type="hidden" name="on_discount" value="0">

                                    <!-- Discount -->
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
                                    <div class="text-end">
                                        <button id="submit-button" type="submit" class="btn btn-primary">Add
                                            New {{$service->name}} Package
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--end col-->
                    <!--end card-->
                </div>

            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
@stop
@push('scripts')
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        <!-- datatable js -->
        document.addEventListener("DOMContentLoaded", function () {
            $('#buttons-datatables').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'print', 'pdf']
            });
        });

        // Assuming you have jQuery available
        $(document).ready(function () {
            // Define the submit button
            var submitButton = $('#submit-button'); // Replace with your actual button ID or class
            submitButton.text('Add New');
            //on load by default name field to be empty
            $('#on_discount').change(function () {
                if (this.checked) {
                    // When checked, show the discount field and disable the hidden input
                    $('#discount-field').show();
                    $('input[type="hidden"][name="on_discount"]').prop('disabled', true);
                } else {
                    // When unchecked, hide the discount field, clear the discount input, and enable the hidden input
                    $('#discount-field').hide();
                    $('#discount').val('');
                    $('input[type="hidden"][name="on_discount"]').prop('disabled', false);
                }
            });

            // Optionally, trigger the change event on page load in case the checkbox is pre-checked (e.g., during edit)
            $('#on_discount').trigger('change');

            // Click event for the edit button
            $('.edit-button').on('click', function () {

                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description');
                var standardPrice = $(this).data('standard-price');
                var onDiscount = $(this).data('on-discount');
                var discount = $(this).data('discount');
                var serviceId = $(this).data('service-id');
                var serviceSlug = $(this).data('service-slug');
                var packageId = $(this).data('package-id');
                var packageCategoryId = $(this).data('package-category-id');

                // Set form action for update, method to PATCH, and button text to Update
                $('#edit-form').attr('action', '/admin/service-package/' + serviceSlug + '/' + id + '/update');
                $('input[name="_method"]').val('PATCH');
                $('#submit-button').text('Update');

                // Populate the form for editing
                $('#name').val(name);
                $('#description').val(description);
                $('#standard_price').val(standardPrice);
                $('#on_discount').prop('checked', onDiscount === 1); // Assuming on_discount is a checkbox
                $('#discount').val(discount);
                $('#service_id').val(serviceId); // Assuming you have a field for service_id
                $('#package_id').val(packageId);
                $('#package_category_id').val(packageCategoryId);

                // Update titles or any other elements as needed
                $('#card-title').text('Edit - ' + name + ' Service Package');
                $('#page-title').text('Edit - ' + name + ' Service Package');

                $('#on_discount').trigger('change');
            });

            // Click event for adding a new item
            $('#new-button').on('click', function () {
                // Clear the form, set action for creation, method to POST, and button text to Add New
                $('#edit-form').attr('action', 'admin/counting-methods/store');
                $('input[name="_method"]').val('POST');
                submitButton.text('Add New');
                $('#name').val('');
                $('#card-title').text('Add Service Package');
                $('#page-title').text('Add New Service Package');
            });
        });


    </script>

@endpush
