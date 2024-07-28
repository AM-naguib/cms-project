@extends('dashboard.layout.app')
@section('content')
    <div class="row">
        <div class="  col-12 ">
            <div class="card p-3">
                <h1>Edit Post</h1>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form action="{{ route('dashboard.posts.update',$post) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    {{-- <div class="form d-flex flex-column flex-sm-wrap flex-md-row"> --}}
                    <div class="form col-12 d-flex justify-content-between">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="title" class="form-label required">Title</label>
                                <input type="text" id="title" class="form-control" name="title" required
                                    value="{{ $post->title }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label required">Description</label>
                                <textarea name="description" id="description" class="form-control">{{$post->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="watch_urls" class="form-label required">Watch Urls</label>
                                <textarea name="watch_urls" id="watch_urls" class="form-control">{{ $post->watch_urls }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="download_urls" class="form-label required">Download Urls</label>
                                <textarea name="download_urls" id="download_urls" class="form-control">{{ $post->download_urls }}</textarea>
                            </div>
                            <div class="mb-3 d-flex flex-column">
                                <label for="keywords" class="form-label required">Keywords</label>
                                <select id="keywords" multiple="multiple" name="keywords[]" class="select-form">
                                    @foreach ($keywords as $keyword)
                                        <option @if ($post->keywords->contains($keyword))
                                            selected
                                        @endif value="{{ $keyword->id }}">{{ $keyword->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 d-flex flex-column">
                                <label for="image" class="form-label">Post Image</label>
                                <img  class="mb-3" src="{{ $post->image() }}" alt="" width="100" height="100">
                                <label for="image" class="form-label">Click here to update image</label>
                                <input type="file" hidden class="form-control" name="image" id="image">
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3 d-flex flex-column">
                                    <label for="category" class="form-label required">Category</label>
                                    <input type="text" class="form-control category" value="{{ $post->category->name }}" name="category" id="category"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3 d-flex flex-column">
                                    <label for="main_name" class="form-label required">Main Name</label>
                                    <input type="text" class="form-control main_name" value="{{ $post->main_name->name }}" name="main_name" id="main_name"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3 d-flex flex-column">
                                    <label for="genre" class="form-label required">Genre</label>
                                    <select id="genres" multiple="multiple" name="genres[]" class="select-form">
                                        @foreach ($genres as $genre)
                                            <option @if ($post->genres->contains($genre))
                                                selected
                                            @endif  value="{{ $genre->id }}">{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3 d-flex flex-column">
                                    <label for="quality" class="form-label required">Quality</label>
                                    <input type="text" class="form-control quality" value="{{ $post->quality->name}}" name="quality" id="quality"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3 d-flex flex-column">
                                    <label for="year" class="form-label required">Year</label>
                                    <input type="number" class="form-control year" name="year" value="{{ $post->year->name}}"  id="year" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3 d-flex flex-column">
                                    <label for="episode_number" class="form-label required">Episode Number</label>
                                    <input type="number" class="form-control" name="episode_number" value="{{ $post->episode_number}}" id="episode_number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3 d-flex flex-column">
                                    <label for="duration" class="form-label required">Duration</label>
                                    <input type="number" class="form-control" name="duration" value="{{ $post->duration}}" id="duration">
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let label = {!! json_encode($categories) !!};
            let main_name = {!! json_encode($main_name) !!};
            let categories = {!! json_encode($categories) !!};
            let qualities = {!! json_encode($qualities) !!};
            // $('.genre').typeahead({
            //     source: label.map(function(item) {
            //         return item.name;
            //     })
            // });
            $('.main_name').typeahead({
                source: main_name.map(function(item) {
                    return item.name;
                })
            });
            $('.category').typeahead({
                source: categories.map(function(item) {
                    return item.name;
                })
            });
            $('.quality').typeahead({
                source: qualities.map(function(item) {
                    return item.name;
                })
            });

            $('#keywords').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true // add additional parameters
                    };
                }
            });
            $('#genres').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true // add additional parameters
                    };
                }
            });
        });
    </script>
@endsection
