@extends('front.layout.app')

@section('title', getSettings()->site_title . '| الرئيسية')
@section('description', getSettings()->site_description ?? '')
@section('keywords', getSettings()->site_keywords ?? '')
@section('schema')
    <!-- Schema Meta Data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "{{ getSettings()->site_title }}",
            "url": "{{ url()->current() }}", 
            "description": "{{ getSettings()->site_description }}",
            "sameAs": [
                "https://www.facebook.com/اسم_صفحتك",
                "https://www.twitter.com/اسم_حسابك"
            ],
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ url('/search?q={search_term_string}') }}",
                "query-input": "required name=search_term_string"
            }
        }
        </script>


@endsection
@section('content')

    <section class="banner-container">
        <div class="movie-banner">
            <div class="swiper swiper-banner-container" data-swiper="banner-detail-slider">
                <div class="swiper-wrapper">
                    @forelse ($headerSlider as $post)
                        <div class="swiper-slide movie-banner-1 p-0">
                            <div class="movie-banner-image">
                                <img src="storage/{{ $post->image_url }}" alt="movie-banner-image">
                            </div>
                            <div class="shows-content h-100">
                                <div class="row align-items-center h-100">
                                    <div class="col-lg-7 col-md-12">
                                        <h3 class="texture-text big-font letter-spacing-1 line-count-1 text-uppercase RightAnimate-two"
                                            data-animation-in="fadeInLeft" data-delay-in="0.6">
                                            {{ $post->title }}
                                        </h3>
                                        <div class="flex-wrap align-items-center fadeInLeft animated"
                                            data-animation-in="fadeInLeft" style="opacity: 1;">
                                            <div class="slider-ratting d-flex align-items-center gap-3">
                                                <ul
                                                    class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                                                    <li>
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star-half" aria-hidden="true"></i>
                                                    </li>
                                                </ul>
                                                <span class="text-white">
                                                    3.5(lmdb)
                                                </span>
                                            </div>
                                            {{-- <div class="d-flex flex-wrap align-items-center gap-3 movie-banner-time">
                                            <span class="badge bg-secondary p-2">
                                                <i class="fa fa-eye"></i>
                                                PG
                                            </span>
                                            <span class="font-size-6">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="trending-time font-normal">
                                                1hr 44mins
                                            </span>
                                            <span class="font-size-6">
                                                <i class="fa-solid fa-circle"></i>
                                            </span>
                                            <span class="trending-year font-normal">
                                                Feb 2018
                                            </span>
                                        </div> --}}
                                            <p class="movie-banner-text line-count-3" data-animation-in="fadeInUp"
                                                data-delay-in="1.2">
                                                {{ $post->description }}
                                            </p>
                                        </div>
                                        <div class="iq-button" data-animation-in="fadeInUp" data-delay-in="1.2">
                                            <a href="{{ route('front.single', $post->slug) }}"
                                                class="btn text-uppercase position-relative">
                                                <span class="button-text">Play Now</span>
                                                <i class="fa-solid fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg-5 col-md-12 trailor-video iq-slider d-none d-lg-block position-relative">
                                        <a href="{{ route('front.single', $post->slug) }}"
                                            class="video-open playbtn text-decoration-none" tabindex="0">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px"
                                                height="80px" viewBox="0 0 213.7 213.7"
                                                enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                                                <polygon class="triangle" fill="none" stroke-width="7"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                    points="73.5,62.5 148.5,105.8 73.5,149.1 ">
                                                </polygon>
                                                <circle class="circle" fill="none" stroke-width="7"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                    cx="106.8" cy="106.8" r="103.3">
                                                </circle>
                                            </svg>
                                            <span class="w-trailor text-uppercase"> Watch Now </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                    @endforelse

                </div>
                <div class="swiper-banner-button-next">
                    <i class="iconly-Arrow-Right-2 icli arrow-icon"></i>
                </div>
                <div class="swiper-banner-button-prev">
                    <i class="iconly-Arrow-Left-2 icli arrow-icon"></i>
                </div>
            </div>
        </div>
    </section>

    @if (getSettings()->slide_show == 1)
        @forelse ($mainCategories as $mainCategory)
            @if ($mainCategory->latestPosts->count() <= 0)
                @continue
            @endif
            <section class="recommended-block">
                <div class="container-fluid">
                    <div class="overflow-hidden">
                        <div class="d-flex align-items-center justify-content-between px-3 my-4">
                            <h2 class="main-title text-capitalize mb-0 fs-3">احدث ال{{ $mainCategory->name }}</h2>

                        </div>
                        <div class="card-style-slider">
                            <div class="position-relative swiper swiper-card" data-slide="6" data-laptop="5" data-tab="3"
                                data-mobile="2" data-mobile-sm="2" data-autoplay="false" data-loop="true"
                                data-navigation="true" data-pagination="true">
                                <ul class="p-0 swiper-wrapper m-0  list-inline">

                                    @forelse ($mainCategory->latestPosts->take(20) as $post)
                                        <li class="swiper-slide">
                                            <a href="{{ route('front.single', $post->slug) }}"
                                                class="position-relative d-block">
                                                <div class="iq-card">
                                                    <div class="block-images position-relative w-100">
                                                        <div class="img-box w-100">
                                                            <img src="../storage/{{ $post->image_url }}" alt="movie-card"
                                                                class="img-fluid object-cover w-100 d-block border-0">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post-title p-1">
                                                    <h5 class="text-center"><a
                                                            href="{{ route('front.single', $post->slug) }}">{{ $post->title }}
                                                        </a>
                                                    </h5>
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                        <li>لا توجد بوستات حالياً.</li>
                                    @endforelse
                                </ul>
                                <div class="swiper-button swiper-button-next"></div>
                                <div class="swiper-button swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @empty
            <p>لا توجد تصنيفات رئيسية متاحة حالياً.</p>
        @endforelse
    @endif



    <section class="recommended-block section-top-spacing">
        <div class="container-fluid">
            <div class="overflow-hidden">
                <div class="d-flex align-items-center justify-content-between px-3 my-4">
                    <h5 class="main-title text-capitalize mb-0">احدث المواضيع</h5>
                    <a href="{{ route('front.new') }}" class="text-primary iq-view-all text-decoration-none">مشاهدة الكل
                    </a>
                </div>
                <div class="card-style-grid">
                    <div class="row row-cols-xl-6 row-cols-md-2 row-cols-1">
                        @forelse ($posts as $post)
                            <div class="col mb-4">
                                <a href="{{ route('front.single', $post->slug) }}" class="position-relative d-block">
                                    <div class="iq-card">
                                        <div class="block-images position-relative w-100">
                                            <div class="img-box w-100">
                                                <img src="../storage/{{ $post->image_url }}" alt="movie-card"
                                                    class="img-fluid object-cover w-100 d-block border-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-title p-1">
                                        <h5 class="text-center"><a
                                                href="{{ route('front.single', $post->slug) }}">{{ $post->title }} </a>
                                        </h5>
                                    </div>
                                </a>
                            </div>
                        @empty
                        @endforelse


                    </div>
                    <!-- Pagination -->
                    {!! $posts->links('vendor.pagination.default') !!}
                </div>
            </div>
        </div>
    </section>





@endsection
