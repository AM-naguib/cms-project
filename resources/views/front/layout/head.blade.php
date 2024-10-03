<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ getSettings()->site_title }} | @yield('title')</title>
    <!-- Google Font Api KEY-->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ env('APP_URL') }}/storage/{{ getSettings()->site_favicon }}" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/css/core/libs.min.css" />

    <!-- font-awesome css -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/vendor/font-awesome/css/all.min.css" />

    <!-- Iconly css -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/vendor/iconly/css/style.css" />

    <!-- Animate css -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/vendor/animate.min.css" />

    <!-- SwiperSlider css -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/vendor/swiperSlider/swiper.min.css">

    <!-- Schema Meta Start-->
    @yield('schema')
    <!-- Schema Meta End-->


    <!-- Streamit Design System Css -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/css/streamit.min848f.css?v=5.2.1" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/css/custom.min848f.css?v=5.2.1" />

    <!-- Rtl Css -->
    <link rel="stylesheet" href="{{ asset('front/new') }}/css/rtl.min848f.css?v=5.2.1" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&amp;display=swap"
        rel="stylesheet">


    <style>
        .page-numbers {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            margin: 0 0.2rem;
            border: 1px solid #ddd;
            border-radius: 0.3rem;
            text-decoration: none;
            color: #007bff;
            background-color: white;
        }

        .page-numbers.current {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .page-numbers.disabled {
            color: #6c757d;
            cursor: not-allowed;
        }

        .page-numbers.next {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            margin: 0 0.2rem;
            border: 1px solid #ddd;
            border-radius: 0.3rem;
            text-decoration: none;
            color: #007bff;
            background-color: white;
        }

        .page-numbers.next span {
            font-size: 1rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .pagination li.active {
            background-color: red;
        }

        .pagination li.disabled {
            padding: 12px 22px;
        }

        .pagination li {
            cursor: pointer;
            display: inline-block;

            background: #141314;
            margin: 10px 0;

        }

        .pagination li a,
        .pagination li.active {
            padding: 12px 22px;
            display: block;
        }
    </style>
</head>
