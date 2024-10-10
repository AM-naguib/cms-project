@extends('front.layout.app')
@section('schema')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "VideoObject",
      "name": "{{ addslashes(str_replace('&nbsp;', '', $post->title)) }}",
      "description": "{{trim($post->description) }}",
      "thumbnailUrl": "{{ env('APP_URL') }}/storage/{{ $post->image_url }}",
      "uploadDate": "{{ $post->updated_at->toIso8601String() }}",
      "contentUrl": "{{ route('front.single', $post->slug) }}",
      "embedUrl": "{{ route('front.single', $post->slug) }}",
      "duration": "{{ $durationInISO8601 }}",
      "isFamilyFriendly": true,
      "playerType": "HTML5 Flash",
      "width": 640,
      "height": 360,
      "keywords": [
        @foreach ($keywords as $keyword)
          "{{ addslashes(str_replace('&nbsp;', '', $keyword)) }}"{!! $loop->last ? '' : ',' !!}
        @endforeach
      ]
    }
    </script>



@endsection

@section('title', 'مشاهدة ' . $post->title . ' HD' ?? '')
@section('description', $post->description ?? '')
@section('keywords', $post->showKeywordsInsinglePost() ?? '')

@section('content')
    <!-- Banner Start -->
    <div class="iq-main-slider site-video">
        <div class="container-fluid">
            @php
                $servers = json_decode($post->watch_urls);
                if ($servers != null) {
                    $firstServer = reset($servers);
                }
            @endphp

            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-2 text-center">
                    @if ($servers != null)
                        @foreach ($servers as $serverName => $url)
                            <button class="btn btn-primary btn-lg my-1"
                                onclick="showIfram('{{ $url }}')">{{ $serverName . $loop->iteration }}</button>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pt-0 mx-auto">
                        <iframe id="watchIframe" src="{{ $firstServer ?? '' }}" scrolling="no" width="100%"
                            height="600px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="details-part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Movie Description Start-->
                    <div class="trending-info mt-4 pt-0 pb-4">
                        <div class="row">
                            <div class="col-md-9 col-12 mb-auto">
                                <div class="d-block d-lg-flex align-items-center">
                                    <h2 class="trending-text fw-bold texture-text text-uppercase my-0 fadeInLeft animated d-inline-block"
                                        data-animation-in="fadeInLeft" data-delay-in="0.6"
                                        style="opacity: 1; animation-delay: 0.6s">
                                        {{ $post->title }}
                                    </h2>

                                    <!-- Schema Markup for VideoObject -->
                                    <div itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
                                        <meta itemprop="name" content="{{ $post->title }}">
                                        <meta itemprop="contentURL" content="{{ route('front.single', $post->slug) }}">
                                        <link itemprop="url" href="{{ route('front.single', $post->slug) }}">
                                        <meta itemprop="description" content="{{ $post->description }}">
                                        <meta itemprop="keywords" content="{{ $post->showKeywordsInsinglePost() }}">
                                        <meta itemprop="duration" content="{{ $post->formatted_duration }}">
                                        <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                                            <meta itemprop="name" content="ADMIN">
                                            <link itemprop="url" href="{{ $post->author_url }}">
                                        </span>
                                        <link itemprop="thumbnailUrl" href="{{ env('APP_URL') }}/storage/{{ $post->image_url }}">
                                        <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
                                            <link itemprop="url" href="{{ env('APP_URL') }}/storage/{{ $post->image_url }}">
                                            <meta itemprop="width" content="640">
                                            <meta itemprop="height" content="360">
                                        </span>
                                        <link itemprop="embedURL" href="{{ route('front.single', $post->slug) }}">
                                        <meta itemprop="playerType" content="HTML5 Flash">
                                        <meta itemprop="width" content="640">
                                        <meta itemprop="height" content="360">
                                        <meta itemprop="isFamilyFriendly" content="True">
                                        <meta itemprop="datePublished" content="{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d\TH:i:sP') }}">
                                        <meta itemprop="uploadDate" content="{{ \Carbon\Carbon::parse($post->updated_at)->format('Y-m-d\TH:i:sP') }}">
                                    </div>


                                </div>
                                <ul class="p-0 mt-2 list-inline d-flex flex-wrap movie-tag">
                                    @forelse ($post->genres as $genre)
                                        <li class="trending-list"><a class="text-primary"
                                                href="{{ $genre->slug }}">{{ $genre->name }}</a></li>

                                    @empty
                                    @endforelse

                                </ul>


                                <ul class="iq-blogtag list-unstyled d-flex flex-wrap align-items-center gap-3 p-0">
                                    <li class="iq-tag-title text-primary mb-0">
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        التصنيف:
                                    </li>
                                    <li> <a class="title"
                                            href="{{ $post->category->slug }}">{{ $post->category->name }}</a></li>

                                </ul>
                                <ul class="iq-blogtag list-unstyled d-flex flex-wrap align-items-center gap-3 p-0">
                                    <li class="iq-tag-title text-primary mb-0">
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        الكلمات المفتاحية:
                                    </li>
                                    @forelse ($post->keywords as $keyword)
                                        <li><a class="title" href="{{ $keyword->slug }}">{{ $keyword->name }}</a><span
                                                class="text-secondary"> </span></li>

                                    @empty
                                    @endforelse

                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Movie Description End --> <!-- Movie Source Start -->
                    <div class="content-details trending-info">
                        <ul class="iq-custom-tab tab-bg-gredient-center d-flex nav nav-pills align-items-center text-center mb-5 justify-content-center list-inline"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="pill" href="#description-01" role="tab"
                                    aria-selected="true">
                                    القصة
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#source-01" role="tab"
                                    aria-selected="false">
                                    سيرفرات التحميل
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="description-01" class="tab-pane animated fadeInUp active show" role="tabpanel">
                                <div class="description-content">
                                    <p>
                                        {{ $post->description }}
                                    </p>
                                </div>
                            </div>

                            <div id="source-01" class="tab-pane animated fadeInUp" role="tabpanel">
                                <div class="source-list-content table-responsive">
                                    <table class="table custom-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    السيرفر
                                                </th>
                                                <th>
                                                    رابط التحميل
                                                </th>

                                            </tr>
                                        </thead>
                                        @php
                                            $downServers = json_decode($post->download_urls);

                                        @endphp

                                        <tbody>
                                            @forelse ($downServers as $key => $serverLink)
                                                <tr>
                                                    <td>
                                                        السيرفر رقم {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        <div class="iq-button">
                                                            <a target="_blank" href="{{ $serverLink }}"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">اضغط للتحميل</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Movie Source End -->
                </div>
            </div>
        </div>
    </div>
    @php
        $mainName = $post->main_name;
    @endphp
    {{-- @dd($mainName->posts()->orderBy('episode_number', 'asc')->get()) --}}
    @if ($mainName->posts()->count() > 1)
        <div class="row">

            <h4 class="text-center">الحلقات</h4>
            <div class="col-8 mx-auto d-flex gap-3 flex-wrap p-2 justify-content-center" style="border: 1px solid red">
                @forelse ($mainName->posts()->orderBy('episode_number', 'asc')->get() as  $episode)
                    <a href="{{ route('front.single', $episode->slug) }}">
                        <div class="box"
                            style="display: inline-block;background: #77252c;padding: 8px 18px;border-radius: 5px;">
                            <span class="fs-5 text-white"><b>{{ $episode->episode_number }}</b></span>
                        </div>
                    </a>
                @empty
                @endforelse

            </div>
        </div>
    @endif
    {{-- <div class="cast-tabs">
        <div class="container-fluid">
            <div class="content-details trending-info g-border iq-rtl-direction">
                <ul class="iq-custom-tab tab-bg-fill d-flex nav nav-pills mb-5 " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-bs-toggle="pill" href="#cast-1" role="tab"
                            aria-selected="true">Cast</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="cast-1" class="tab-pane animated fadeInUp active show" role="tabpanel">
                        <div class="position-relative swiper swiper-card" data-slide="5" data-laptop="5" data-tab="3"
                            data-mobile="2" data-mobile-sm="1" data-autoplay="false" data-loop="false"
                            data-navigation="true" data-pagination="true">
                            <ul class="list-inline swiper-wrapper">

                                <li class="swiper-slide">
                                    <div class="cast-images m-0 row align-items-center position-relative">
                                        <div class="col-8 block-description">
                                            <h6 class="iq-title">
                                                <a href="person-detail.html" tabindex="0">James Chinlund </a>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    <section class="recommended-block">
        <div class="container-fluid">
            <div class="overflow-hidden">
                <div class="d-flex align-items-center justify-content-between px-3 pt-2 my-4">
                    <h5 class="main-title text-capitalize mb-0">مقترح لك</h5>
                </div>
                <div class="card-style-slider">
                    <div class="position-relative swiper swiper-card" data-slide="5" data-laptop="5" data-tab="2"
                        data-mobile="2" data-mobile-sm="2" data-autoplay="false" data-loop="true"
                        data-navigation="true" data-pagination="true">
                        <ul class="p-0 swiper-wrapper m-0  list-inline">
                            @forelse ($post->category->posts->take(10) as  $cPost)
                                <li class="swiper-slide">
                                    <a href="{{ route('front.single', $cPost->slug) }}"
                                        class="position-relative d-block">
                                        <div class="iq-card">
                                            <div class="block-images position-relative w-100">
                                                <div class="img-box w-100">
                                                    <img src="../storage/{{ $cPost->image_url }}" alt="movie-card"
                                                        class="img-fluid object-cover w-100 d-block border-0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-title p-1">
                                            <h5 class="text-center"><a
                                                    href="{{ route('front.single', $cPost->slug) }}">{{ $cPost->title }}
                                                </a>
                                            </h5>
                                        </div>
                                    </a>


                                </li>
                            @empty
                            @endforelse

                        </ul>
                        <div class="swiper-button swiper-button-next"></div>
                        <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script>
        function showIfram(url) {
            $("#watchIframe").attr("src", url);

        }
    </script>
@endsection
