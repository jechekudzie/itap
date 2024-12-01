@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/choices.css') }}" />
@endpush

@section('title', 'Admin Dashboard')

@section('content')
    <div class="col-8 col-xl-8">
        @if(session()->has('errors'))
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <!-- Success Alert -->
                    <div class="alert alert-outline-danger d-flex align-items-center" role="alert">
                        <span class="fas fa-times-circle text-danger fs-3 me-3"></span>
                        <p class="mb-0 flex-1"> {{ $error }}!</p>

                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
        @endif
        @if(session('success'))
            <div class="alert alert-outline-success d-flex align-items-center" role="alert">
                <span class="fas fa-check-circle text-success fs-3 me-3"></span>
                <p class="mb-0 flex-1"> {{ session('success') }}</p>

                <button class="btn-close" type="button" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif
    </div>
    <form class="mb-9" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Add a Product</h2>
                <h5 class="text-700 fw-semi-bold">Fill in the details below to add a new product</h5>
            </div>
            <div class="col-auto">
                <a href="{{route('products.index')}}" class="btn btn-primary mb-2 mb-sm-0" type="submit"><i class="fa-solid fa-caret-left me-2"></i> Back</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit"><i class="fa-solid fa-plus me-2"></i> Publish Product</button>
            </div>

        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-3">
                    <label for="productName" class="form-label"><h4 class="mb-3">Product Name</h4></label>
                    <input class="form-control mb-5" id="productName" type="text" name="name" placeholder="Product name..." required>
                </div>

                <div class="mb-3">
                    <label for="productImage" class="form-label">
                        <h4 class="mb-3">Product Image</h4>
                    </label>
                    <input class="form-control mb-5" id="productImage" type="file" name="image">
                </div>

                <div class="mb-3">
                    <label for="productDescription" class="form-label"><h4 class="mb-3">Product Description</h4></label>
                    <textarea class="tinymce" name="description" data-tinymce='{"height":"15rem","placeholder":"Write a description here..."}'></textarea>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Product Details</h4>
                        <div class="mb-4">
                            <label for="productCategory" class="form-label">Category</label>
                            <select class="form-select mb-3" id="productCategory" name="category_id" required>
                                <option selected disabled>Select Category</option>
                                <!-- Loop through categories and display them as options -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="customerPrice" class="form-label">Customer Price</label>
                            <input class="form-control mb-3" id="customerPrice" type="number" step="0.01" name="customer_price" placeholder="Customer price...">
                        </div>

                        <div class="mb-4">
                            <label for="dealerPrice" class="form-label">Dealer Price</label>
                            <input class="form-control mb-3" id="dealerPrice" type="number" step="0.01" name="dealer_price" placeholder="Dealer price...">
                        </div>

                        <div class="mb-4 form-check">
                            <input class="form-check-input" id="on_discount" type="checkbox" name="on_discount" value="1">
                            <label class="form-check-label" for="onDiscount">On Discount</label>
                        </div>
                        <input type="hidden" name="on_discount" value="0">

                        <div class="mb-4" id="discount-field" style="display: none;">
                            <label for="discountPercentage" class="form-label">Discount Percentage (%)</label>
                            <input class="form-control mb-3" id="discount" type="number" step="0.01" name="discount_percentage" placeholder="Discount percentage...">
                        </div>

                        <div class="mb-4 form-check">
                            <input class="form-check-input" id="cost_per_unit" type="checkbox" name="cost_per_unit" value="1">
                            <label class="form-check-label" for="">Charged Per Unit?</label>
                        </div>
                        {{--<input type="hidden" name="cost_per_unit" value="0">--}}

                        <div class="mb-4">
                            <h5 class="mb-2">Select Shops</h5>
                            @foreach ($shops as $shop)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="shop{{ $shop->id }}" name="shops[]" value="{{ $shop->id }}">
                                    <label class="form-check-label" for="shop{{ $shop->id }}">{{ $shop->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('scripts')

    <!-- TinyMCE Editor -->

    <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function () {

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

            setTimeout(function() {
                $('.alert').fadeOut('slow', function() {
                    $(this).remove(); // Remove the alert from the DOM after fading out
                });
            }, 5000);
        });

    </script>

@endpush
