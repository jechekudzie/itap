@extends('layouts.admin')

@push('head')

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0" id="page-title">Configure {{$service->name}} Packages</h4>
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

                                        <a href="{{route('service-packages.index',$service->slug)}}" class="btn btn-info btn-sm add-btn">
                                            <i class="fa fa-arrow-left"></i> Back
                                        </a>
                                        <a id="new-button" class="btn btn-success btn-sm add-btn">
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
                        <div class="card">
                            <div class="card-body">
                                <!--start table-->

                                <form action="{{ route('service-packages.line-items.store', $servicePackage->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="service_package_id" value="{{ $servicePackage->id }}">

                                        @foreach(\App\Models\LineItemCategory::with('lineItems')->get() as $category)
                                            <div class="mb-4">
                                                <h5 class="mb-3">{{ $category->name }}</h5>
                                                <div class="row g-3">
                                                    @foreach($category->lineItems as $lineItem)
                                                        <div class="col-md-4">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                       name="line_items[{{ $lineItem->id }}][checked]"
                                                                       id="line_item_{{ $lineItem->id }}"
                                                                       value="{{ $lineItem->id }}"
                                                                       @if($servicePackage->packageLineItems->contains('line_item_id', $lineItem->id)) checked @endif>
                                                                <label class="form-check-label" for="line_item_{{ $lineItem->id }}">
                                                                    {{ $lineItem->name }}
                                                                </label>
                                                            </div>
                                                            <input type="number"
                                                                   name="line_items[{{ $lineItem->id }}][quantity]"
                                                                   class="form-control form-control-sm mb-3"
                                                                   placeholder="Qty"
                                                                   min="0" max="20"
                                                                   style="width: 100px;"
                                                                   value="{{ $servicePackage->packageLineItems->where('line_item_id', $lineItem->id)->first()->quantity ?? 0 }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Add Line Items</button>
                                        </div>
                                    </div>
                                </form>


                                <!--end table-->
                            </div>
                        </div>
                    </div>
                    <!--end col-->

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

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            let isValid = true;

            document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
                let quantityInput = checkbox.closest('.col-md-4').querySelector('input[type="number"]');

                if (checkbox.checked && !quantityInput.value) {
                    isValid = false;
                    quantityInput.classList.add('is-invalid'); // Highlight the input field in red
                } else {
                    quantityInput.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault(); // Prevent form submission
                alert('Please enter a quantity for all checked line items.');
            }
        });

    </script>
@endpush
