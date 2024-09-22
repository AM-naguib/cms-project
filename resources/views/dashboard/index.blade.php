@extends('dashboard.layout.app')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            {{-- Main Categories --}}
            <a href="{{ route('dashboard.main-categories.index') }}" class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4 d-flex flex-column align-items-center justify-content-between">
                        <div class="item-name">
                            <h3 class="">Main Categories</h3>
                        </div>
                        <div class="stat ">
                            <h3 class="mb-0">{{ $mainCategories }}</h3>
                        </div>
                    </div>
                </div>
            </a>


            {{-- Categories --}}
            <a href="{{ route('dashboard.categories.index') }}" class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4 d-flex flex-column align-items-center justify-content-between">
                        <div class="item-name">
                            <h3 class="">Categories</h3>
                        </div>
                        <div class="stat ">
                            <h3 class="mb-0">{{ $categories }}</h3>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Posts --}}
            <a href="{{ route('dashboard.posts.index') }}" class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4 d-flex flex-column align-items-center justify-content-between">
                        <div class="item-name">
                            <h3 class="">Posts</h3>
                        </div>
                        <div class="stat ">
                            <h3 class="mb-0">{{ $posts }}</h3>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Years --}}
            <a href="{{ route('dashboard.years.index') }}" class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4 d-flex flex-column align-items-center justify-content-between">
                        <div class="item-name">
                            <h3 class="">Years</h3>
                        </div>
                        <div class="stat ">
                            <h3 class="mb-0">{{ $years }}</h3>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Gears --}}
            <a href="{{ route('dashboard.genres.index') }}" class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4 d-flex flex-column align-items-center justify-content-between">
                        <div class="item-name">
                            <h3 class="">Gears</h3>
                        </div>
                        <div class="stat ">
                            <h3 class="mb-0">{{ $genres }}</h3>
                        </div>
                    </div>
                </div>
            </a>


            {{-- Keywords --}}

            <a href="{{ route('dashboard.keywords.index') }}" class="col-12 col-sm-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4 d-flex flex-column align-items-center justify-content-between">
                        <div class="item-name">
                            <h3 class="">Keywords</h3>
                        </div>
                        <div class="stat ">
                            <h3 class="mb-0">{{ $keywords }}</h3>
                        </div>
                    </div>
                </div>

            </a>


        </div>




    </div>
@endsection
