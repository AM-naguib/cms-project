<!DOCTYPE html>
<html lang="en" dir="rtl">

<!-- Head Start -->
@include('front.layout.head')
<!-- Head End -->

<body>
    <!-- header -->
    @include('front.layout.header')
    <!-- end header -->

    @yield('content')

    <!-- footer -->
    @include('front.layout.footer')
    <!-- end footer -->
    <!-- JS -->
    @include('front.layout.scripts')
</body>

</html>
