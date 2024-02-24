@extends('layouts.website')

@stack('styles')

@section('title', 'iTAP Media - Welcome to our website')

@section('content')
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

        .my-custom-padding {
            padding-top: 10px; /* Adjust the top padding as needed */
            padding-bottom: 10px; /* Adjust the bottom padding as needed */
        }

        .custom-category-header {
            margin-bottom: 3rem; /* Adjust the value as needed */
        }


    </style>
    <!-- ===============  breadcrumb area start =============== -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="page-outlined-text">
                            <h1></h1>
                        </div>
                        <h2 class="page-title">{{$service->name}}</h2>
                        <ul class="page-switcher">
                            <li><a href="index.html">Home <i class="bi bi-caret-right"></i></a></li>
                            <li>{{$service->serviceCategory->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===============  breadcrumb area end =============== -->


    <!-- ===============  Recent schedule start  =============== -->
    <div class="pricing-wrapper">
        <div class="container position-relative pt-110">
            <div class="row">
                <div class="col-lg-12">
                    <div class="background-title text-style-one">
                        {{--<h2 style="background-color: #ce1446 !important;">{{$service->name}} Packages</h2>--}}
                    </div>
                    <div class="section-head">
                        <h3>Choose <span style="color: #ce1446 !important;"
                                         class=" text-style-one">{{$service->name}}</span> Package</h3>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="event-category-buttons d-flex justify-content-center">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach($groupedPackages as $categoryId => $packagesInCategory)
                                @php
                                    // Get the category from the first package in each group
                                    $category = $packagesInCategory->first()->packageCategory;
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="pills-tab{{$category->id}}" data-bs-toggle="pill"
                                            data-bs-target="#pills-pricing{{$category->id}}" type="button"
                                            role="tab"
                                            aria-controls="pills-pricing1" aria-selected="true">
                                        {{$category->name}} </button>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="all-pricing-tables">
                        <div class="tab-content" id="pills-tabContent">
                            @foreach($groupedPackages as $categoryId => $packagesInCategory)
                                @php
                                    // Get the category from the first package in each group
                                    $category = $packagesInCategory->first()->packageCategory;
                                @endphp

                                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}"
                                     id="pills-pricing{{$category->id}}" role="tabpanel"
                                     aria-labelledby="pills-tab{{$category->id}}">
                                    <div class="row">

                                        @foreach($packagesInCategory as $servicePackage)

                                            <div class="col-lg-4 col-md-6 custom-card">
                                                <div class="pricing-card active">
                                                    <div class="pricing-card-top">
                                                        <h5 class="plan-status">
                                                            @if($servicePackage->on_discount)
                                                                @php
                                                                    $discountPercentage = $servicePackage->discount;
                                                                @endphp
                                                                <div class="pricing-card-lavel">
                                                                    <span>{{$discountPercentage}}%</span> Off
                                                                </div>
                                                            @else
                                                                {{''}}
                                                            @endif
                                                            {{ $servicePackage->package->name }}
                                                        </h5>
                                                        @if($servicePackage->on_discount)
                                                            @php
                                                                // Calculate discounted price
                                                                $discountAmount = ($servicePackage->standard_price * $servicePackage->discount) / 100;
                                                                $discountedPrice = $servicePackage->standard_price - $discountAmount;
                                                            @endphp

                                                            <h6 {{--style="font-size: 30px;"--}} class="plan-price">
                                                                <span
                                                                    style="text-decoration: line-through;">$ {{ number_format($servicePackage->standard_price, 2) }}</span>
                                                                <span>${{ number_format($discountedPrice, 2) }}</span>
                                                            </h6>

                                                        @else
                                                            <h3 class="plan-price">
                                                                <span>$</span> {{ number_format($servicePackage->standard_price, 2) }}
                                                            </h3>
                                                        @endif

                                                    </div>

                                                    <div class="card-content">
                                                        @foreach($lineItemCategories as $category)
                                                            @php
                                                                // Filter packageLineItems for the current category
                                                                $items = $servicePackage->packageLineItems->filter(function ($item) use ($category) {
                                                                    return $item->lineItem && $item->lineItem->line_item_category_id == $category->id;
                                                                });
                                                            @endphp
                                                            @if($items->isNotEmpty())
                                                                <!-- Added mb-3 for bottom margin to the h6 element -->
                                                                <h6 style="padding-top: 20px;margin-left: 10px;"
                                                                    class="text-uppercase text-danger font-bold mb-3 custom-category-header">{{ $category->name }}</h6>
                                                                <ul class="list-unstyled vstack gap-3 text-muted">
                                                                    @foreach($items as $item)
                                                                        <li style="margin-left: 15px;color: black;"
                                                                            class="d-flex justify-content-between align-items-center text-black">
                                                                            {{ $item->lineItem->name ?? 'N/A' }}
                                                                            @if($item->quantity > 0)
                                                                                <span style="margin-right: 15px;"
                                                                                      class="badge bg-danger rounded-pill">{{ $item->quantity }}</span>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif

                                                        @endforeach

                                                        <div class="mt-4">
                                                            <a href="{{ route('service-packages.line-items.create', $servicePackage->id) }}"
                                                               class="btn btn-danger w-100 waves-effect waves-light">Book
                                                                Now</a>
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
            </div>
        </div>
    </div>
    <!-- ===============  Recent schedule end  =============== -->

@endsection

@stack('scripts')
