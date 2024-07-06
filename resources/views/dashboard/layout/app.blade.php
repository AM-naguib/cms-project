<!DOCTYPE html>
<!--
  HOW TO USE:
  data-layout: fluid (default), boxed
  data-sidebar-theme: dark (default), colored, light
  data-sidebar-position: left (default), right
  data-sidebar-behavior: sticky (default), fixed, compact
-->
<html lang="en" data-bs-theme="dark" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left"
    data-sidebar-behavior="sticky">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    @include('dashboard.partials.head')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Start -->
        @include('dashboard.partials.sidebar')
        <!-- Sidebar End -->
        <div class="main">
            <!-- Top Navbar Start -->
            @include('dashboard.partials.top_nav')
            <!-- Top Navbar End -->

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')

                    <!-- Footer Start -->
                    @include('dashboard.partials.footer')
                    <!-- Footer End -->

                </div>
        </div>
    </div>



    <!-- Scripts Start -->
    @include('dashboard.partials.scripts')
    <!-- Scripts End -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('js')

</body>


<!-- Mirrored from appstack.bootlab.io/dashboard-default by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2024 17:48:47 GMT -->

</html>
