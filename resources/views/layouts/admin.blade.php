<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none">

<head>
    <meta charset="utf-8"/>
    <title>iTAP -ADMIN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('administration/assets/images/favicon.ico')}}">

    <!-- Sweet Alert css-->
    <link href="{{asset('administration/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Layout config Js -->
    <script src="{{asset('administration/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('administration/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('administration/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('administration/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{asset('administration/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awsome Icons Css V4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Gijgo config file -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
    <style>
        .gj-tree-bootstrap-4 ul.gj-list-bootstrap li.active {
            background-color: gray !important;
        }
    </style>

    @stack('head')
</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{url('/')}}" class="logo logo-dark"></a>

                        <a href="{{url('/')}}" class="logo logo-light">
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    </button>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class='bx bx-bell fs-22'></i>
                            <span
                                class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">1<span
                                    class="visually-hidden">unread messages</span></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                        id="notificationItemsTab" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                                               role="tab"
                                               aria-selected="true">
                                                All (1)
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="tab-content" id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">
                                        <div
                                            class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="flex-1">
                                                    <a href="#" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base">
                                                            <span>Test notification</span>
                                                        </h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i
                                                                class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="my-3 text-center">
                                            <button type="button" class="btn btn-soft-success waves-effect waves-light">
                                                View
                                                All Notifications <i class="ri-arrow-right-line align-middle"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                    @if(auth()->check())
                                        {{auth()->user()->name}}
                                    @endif
                                </span>
                                <span
                                    class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">iTAP Media</span>
                            </span>
                        </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Profile</span></a>

                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Taskboard</span></a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Settings</span></a>


                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="route('logout')"
                                   onclick="event.preventDefault();
                                                this.closest('form').submit();"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">Logout</span></a>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="{{url('/')}}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('logo/logo.png')}}" alt="" height="120">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('logo/logo.png')}}" alt="" height="120">
                </span>
            </a>
            <!-- Light Logo-->
            <a href="{{url('/')}}" class="logo logo-light">
                 <span class="logo-sm">
                     <img src="{{asset('logo/logo.png')}}" alt="" height="120">
                 </span>
                <span class="logo-lg">
                     <img src="{{asset('logo/logo.png')}}" alt="" height="120">
                 </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>
        <!-- LOGO -->

        <!-- SIDEBARD -->
        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu"></div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Admin Menu</span></li>

                    <li class="nav-item">
                        <a style="font-weight: bolder;" class="nav-link menu-link collapsed" href="#sidebarDashboards"
                           data-bs-toggle="collapse"
                           role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <span data-key="t-dashboards">Manage Organisation</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('admin.organisation-types.index')}}"
                                       class="nav-link {{ Request::routeIs('admin.organisation-types*') ? 'active' : '' }}">
                                        Add Organisation Structure
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.organisations.index')}}"
                                       class="nav-link {{ Request::routeIs('admin.organisations.index') ? 'active' : '' }}">
                                        Add Structure Type
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.organisations.manage')}}"
                                       class="nav-link {{ Request::routeIs('admin.organisations.manage') ? 'active' : '' }}">
                                        Manage Organisation
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a style="font-weight: bolder;" class="nav-link menu-link collapsed" href="#permissions"
                           data-bs-toggle="collapse"
                           role="button" aria-expanded="false" aria-controls="permissions">
                            <span data-key="t-dashboards">Modules & Permissions</span>
                        </a>
                        <div class="collapse menu-dropdown" id="permissions">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('admin.permissions.index')}}"
                                       class="nav-link {{ Request::routeIs('admin.permissions.index') ? 'active' : '' }}">
                                        Modules & Permissions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-title"><span data-key="t-menu">System Modules</span></li>
                    <li class="nav-item">
                        <a style="font-weight: bolder;" class="nav-link menu-link collapsed" href="#services"
                           data-bs-toggle="collapse"
                           role="button" aria-expanded="false" aria-controls="services">
                            <span data-key="t-dashboards">Services</span>
                        </a>
                        <div class="collapse menu-dropdown" id="services">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('services.index')}}"
                                       class="nav-link {{ Request::routeIs('services.index') ? 'active' : '' }}">
                                       Manage Services
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a style="font-weight: bolder;" class="nav-link menu-link collapsed" href="#package"
                           data-bs-toggle="collapse"
                           role="button" aria-expanded="false" aria-controls="package">
                            <span data-key="t-dashboards">Packages Configuration</span>
                        </a>
                        <div class="collapse menu-dropdown" id="package">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{route('package-categories.index')}}"
                                       class="nav-link {{ Request::routeIs('package-categories.index') ? 'active' : '' }}">
                                        Package Categories
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('packages.index')}}"
                                       class="nav-link {{ Request::routeIs('packages.index') ? 'active' : '' }}">
                                        iTAP Packages
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="menu-title"><span data-key="t-menu">All Booking</span></li>
                    <li class="nav-item">
                        <a style="font-weight: bolder;" class="nav-link menu-link collapsed" href="#services"
                           data-bs-toggle="collapse"
                           role="button" aria-expanded="false" aria-controls="services">
                            <span data-key="t-dashboards">Bookings & Payment</span>
                        </a>
                        <div class="collapse menu-dropdown" id="services">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('bookings.index')}}"
                                       class="nav-link {{ Request::routeIs('bookings.index') ? 'active' : '' }}">
                                        Bookings
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('bookings.index')}}"
                                       class="nav-link {{ Request::routeIs('bookings.index') ? 'active' : '' }}">
                                        Payments
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
        <!-- SIDEBARD -->

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <div class="main-content">
        @yield('content')
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>{{date('Y')}}</script>
                        © iTAP Media.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Leading Digital
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!-- JAVASCRIPT -->
<script src="{{asset('administration/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('administration/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('administration/assets/libs/node-waves/waves.min.js')}}"></script>

<script src="{{asset('administration/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('administration/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('administration/assets/js/plugins.js')}}"></script>

<!-- list.js min js -->
<script src="{{asset('administration/assets/libs/list.js/list.min.js')}}"></script>
<script src="{{asset('administration/assets/libs/list.pagination.js/list.pagination.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('administration/assets/js/app.js')}}"></script>

<script>
    $(document).ready(function () {
        // Iterate over each active nav-link
        $('.nav-link.active').each(function () {
            // Traverse up to find the parent 'menu-link'
            var parentMenuLink = $(this).closest('.collapse').prev('.menu-link');

            // Check if parentMenuLink is found
            if (parentMenuLink.length) {
                // Remove 'collapsed' class, set 'aria-expanded' to true, and add 'active' class
                parentMenuLink.removeClass('collapsed').addClass('active').attr('aria-expanded', 'true');

                // Expand the parent collapse menu
                $(this).closest('.collapse').addClass('show');
            }
        });
    });

</script>
@stack('scripts')


</body>

</html>
