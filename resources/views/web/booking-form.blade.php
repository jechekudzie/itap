@extends('layouts.website')

@stack('styles')

@section('title', 'iTAP Media - Welcome to our website')

@section('content')
    @livewireStyles
    <style>
        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .primary-input-group {
            flex: 1;
            margin-right: 10px;
        }

        .primary-input-group.full-width {
            flex: 0 0 100%;
            margin-right: 0;
        }

        .primary-input-group:last-child {
            margin-right: 0;
        }

        .wizard-step {
            display: none;
        }

        .active-step {
            display: block;
        }

        .submit-btn, .next-btn, .prev-btn {
            margin-top: 20px;
        }

        /* Adjustments might be needed based on your existing styles */

    </style>
    <div class="main-slider-wrapper gray-300">
        <!-- ===============  hero area start  =============== -->
        <div class="hero-area">

            <div class="container">
                <div class="swiper-container hero-slider overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="slide-content">
                                        <h2>EVENTS, MEETUPS &
                                            <span>CONFERENCES</span></h2>

                                        <div class="slider-btns">
                                            <a href="event-details.html" class="primary-btn-fill">Book Now</a>
                                            <a href="event-details.html" class="primary-btn-outline">View Details</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 text-center">
                                    <div class="slide-figure  position-relative d-lg-flex justify-content-center">
                                        <img src="assets/images/hero/hero-figure1.png" alt="" class="img-fluid">

                                        <div class="animated-shape">
                                            <img src="assets/images/shapes/hero-animi.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="slide-content">

                                        <h2>EVENTS, MEETUPS &
                                            <span>CONFERENCES</span></h2>


                                        <div class="slider-btns">
                                            <a href="event-details.html" class="primary-btn-fill">Book Now</a>
                                            <a href="event-details.html" class="primary-btn-outline">View Details</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 text-center">
                                    <div class="slide-figure  position-relative d-lg-flex justify-content-center">
                                        <img src="assets/images/hero/hero-figure1.png" alt="" class="img-fluid">

                                        <div class="animated-shape">
                                            <img src="assets/images/shapes/hero-animi.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="slider-arrows text-center d-lg-block d-none">

                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"><i
                        class="bi bi-chevron-up"></i></div>
                <div class="hero-pagination d-block w-auto"></div>
                <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"><i
                        class="bi bi-chevron-down"></i></div>
            </div>


        </div>
        <!-- ===============  hero area end  =============== -->

        <!-- ===============  main searchbar area start  =============== -->
        <div class="main-searchbar-area">
            <div class="container">
                <form class="searchbar-wrapper" action="#">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="searchbar-input-group">
                                        <input type="text" placeholder="Event Location....." id="search-location">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="searchbar-input-group">
                                        <input type="text" id="datepicker" placeholder="Date">
                                        <i class="bi bi-calendar2-week"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="searchbar-input-group">
                                        <div class="custom-select filter-options">
                                            <select>
                                                <option value="0">Category</option>
                                                <option value="1"> Category 1</option>
                                                <option value="1">Category 2</option>
                                                <option value="2">Category 3</option>
                                                <option value="3">Category 4</option>
                                                <option value="3">Category 5</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="search-submit">
                                <input type="submit" value="Search Now">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- ===============  main searchbar area end  =============== -->
    </div>


    <!-- ===============  Event Area start  =============== -->
    <div class="event-area gray-300">
        <div class="container position-relative pt-110">
            <div class="row">
                <div class="col-lg-12">
                    <div class="background-title text-style-one">
                        <h2>EVENT</h2>
                    </div>
                    <div class="section-head">
                        <h5>iTAP Media</h5>
                        <h3>{{$servicePackage->package->name}} ({{$servicePackage->packageCategory->name}}) - (${{$servicePackage->standard_price}})</h3>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="all-event-cards">
                        <div class="tab-content" id="events-tabContent">

                            @livewire('booking-form', compact('servicePackageId', 'servicePackage'))



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===============  Event Area end  =============== -->

    @livewireScripts
@endsection
