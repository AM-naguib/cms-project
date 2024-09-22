@extends('front.layout.app')

@section('title', 'المضاف حديثا')
@section('description', getSettings()->site_description ?? '')
@section('keywords', getSettings()->site_keywords ?? '')
@section('content')
    <!--bread-crumb-->

    <div class="iq-breadcrumb" style="background-image: url({{ asset('front/new') }}/images/pages/01.html);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">المضاف حديثا</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <div class="section-padding">
        <div class="container-fluid">
            <div class="card-style-grid">
                <div class="row row-cols-xl-5 row-cols-md-2 row-cols-1">
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

                {!! $posts->links('vendor.pagination.default') !!}

            </div>
        </div>
    </div>
@endsection
