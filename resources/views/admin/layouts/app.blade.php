<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->

    <!-- plugin css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/js/head.js') }}"></script>


</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">

    <!-- Begin page -->
    <div id="app-layout">


        <!-- Topbar Start -->
        <div class="topbar-custom">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <li>
                            <button class="button-toggle-menu nav-link">
                                <i data-feather="menu" class="noti-icon"></i>
                            </button>
                        </li>
                        <li class="d-none d-lg-block">
                            @php
                                $hour = \Carbon\Carbon::now()->hour;
                                if ($hour >= 5 && $hour < 12) {
                                    $greeting = 'Good Morning';
                                } elseif ($hour >= 12 && $hour < 18) {
                                    $greeting = 'Good Afternoon';
                                } else {
                                    $greeting = 'Good Evening';
                                }
                            @endphp
                            <h5 class="mb-0">{{ $greeting }}, {{ Auth::user()->name }}</h5>
                        </li>
                    </ul>

                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                        <!-- Light/Dark Mode Button Themes -->
                        {{-- <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" id="light-dark-mode">
                                <i data-feather="moon" class="align-middle dark-mode"></i>
                                <i data-feather="sun" class="align-middle light-mode"></i>
                            </button>
                        </li> --}}

                        <!-- User Dropdown -->
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/user-13.jpg') }}" alt="user-image"
                                    class="rounded-circle" />
                                <span class="pro-user-name ms-1">{{ Auth::user()->name }} <i
                                        class="mdi mdi-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a class='dropdown-item notify-item' href='pages-profile.html'>
                                    <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a class='dropdown-item notify-item' href='auth-lock-screen.html'>
                                    <i class="mdi mdi-lock-outline fs-16 align-middle"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a class='dropdown-item notify-item' href='{{ route('logout') }}'>
                                    <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <div class="app-sidebar-menu">
            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <div class="logo-box">
                        
                        <a class='logo logo-light' href='index.html'>
                            <h3 class="logo-text mt-3">TMS</h3>
                            {{-- <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24">
                            </span> --}}
                        </a>
                        {{-- <a class='logo logo-light' href='index.html'>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24">
                            </span>
                        </a>
                        <a class='logo logo-dark' href='index.html'>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="24">
                            </span>
                        </a> --}}
                    </div>

                    <ul id="side-menu">

                        <li class="menu-title">Menu</li>

                        <li >
                            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'tp-link active' : '' }}">
                                <i data-feather="home"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('users.index') }}"  class="{{ request()->routeIs('users.*') ? 'tp-link active' : '' }}">
                                <i data-feather="users"></i>
                                <span> Users </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'tp-link active' : '' }}">
                                <i data-feather="user"></i>
                                <span> Customers </span>
                            </a>
                        </li>

                        <li >
                            <a href="{{ route('measurements.create') }}" class="{{ request()->routeIs('measurements.*') ? 'tp-link active' : '' }}">
                                <i data-feather="user"></i>
                                <span> Measurements </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('brands.index') }}" class="{{ request()->routeIs('brands.*') ? 'tp-link active' : '' }}">
                                <i data-feather="package"></i>
                                <span> Brands </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'tp-link active' : '' }}">
                                <i data-feather="grid"></i>
                                <span> Categories </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.*') ? 'tp-link active' : '' }}">
                                <i data-feather="truck"></i>
                                <span> Suppliers </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Inventory</li>

                        <li >
                            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'tp-link active' : '' }}">
                                <i data-feather="box"></i>
                                <span> Products </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('purchases.index') }}" class="{{ request()->routeIs('purchases.*') ? 'tp-link active' : '' }}">
                                <i data-feather="download"></i>
                                <span> Purchases (Stock In) </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'tp-link active' : '' }}">
                                <i data-feather="shopping-cart"></i>
                                <span> Orders </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Reports</li>

                        <li >
                            <a href="{{ route('reports.dashboard') }}" class="{{ request()->routeIs('reports.dashboard') ? 'tp-link active' : '' }}">
                                <i data-feather="bar-chart-2"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('reports.sales') }}" class="{{ request()->routeIs('reports.sales') ? 'tp-link active' : '' }}">
                                <i data-feather="trending-up"></i>
                                <span> Sales Report </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('reports.customers') }}" class="{{ request()->routeIs('reports.customers') ? 'tp-link active' : '' }}">
                                <i data-feather="users"></i>
                                <span> Customer Ledger </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('reports.suppliers') }}" class="{{ request()->routeIs('reports.suppliers') ? 'tp-link active' : '' }}">
                                <i data-feather="pie-chart"></i>
                                <span> Supplier Ledger </span>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('reports.inventory-history') }}" class="{{ request()->routeIs('reports.inventory-history') ? 'tp-link active' : '' }}">
                                <i data-feather="activity"></i>
                                <span> Inventory History </span>
                            </a>
                        </li>

                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                @yield('content')

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy;
                            {{ date('Y') }} - Made with <span class="mdi mdi-heart text-danger"></span> by <a
                                href="#" class="text-reset fw-semibold">Webspires</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
{{-- 
    <!-- Datatables js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- dataTables.bootstrap5 -->
    <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- buttons.colVis -->
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <!-- buttons.bootstrap5 -->
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <!-- dataTables.keyTable -->
    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js"></script>

    <!-- dataTable.responsive -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>


    <!-- dataTables.select -->
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script> --}}


    <!-- Vector map-->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>



    <!-- App js-->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @yield('js')


</body>


</html>
