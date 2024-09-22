@extends('dashboard.layout.app')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-8  col-12 mx-auto">
                <div class="card p-3">
                    <h1>Create Scraping Site</h1>
                    <form action="{{ route('dashboard.scraping_sites.store') }}" method="post" id="formAction">
                        @csrf
                        <div class="mb-3">
                            <label for="site_name" class="form-label required">Site Name</label>
                            <input type="text" id="site_name" class="form-control" name="site_name" required
                                value="{{ old('site_name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="site_url" class="form-label required">Site URL</label>
                            <input type="text" id="site_url" class="form-control" name="site_url" required
                                value="{{ old('site_url') }}">
                        </div>

                        <div class="mb-3">
                            <label for="title_selector" class="form-label">Title Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="title_selector" class="form-control" name="title_selector"
                                    value="{{ old('title_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description_selector" class="form-label">Description Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="description_selector" class="form-control"
                                    name="description_selector" value="{{ old('description_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="watch_urls_selector" class="form-label">Watch URLs Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="watch_urls_selector" class="form-control"
                                    name="watch_urls_selector" value="{{ old('watch_urls_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="download_urls_selector" class="form-label">Download URLs Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="download_urls_selector" class="form-control"
                                    name="download_urls_selector" value="{{ old('download_urls_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category_selector" class="form-label">Category Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="category_selector" class="form-control" name="category_selector"
                                    value="{{ old('category_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quality_selector" class="form-label">Quality Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="quality_selector" class="form-control" name="quality_selector"
                                    value="{{ old('quality_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="year_selector" class="form-label">Year Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="year_selector" class="form-control" name="year_selector"
                                    value="{{ old('year_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="episode_number_selector" class="form-label">Episode Number Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="episode_number_selector" class="form-control"
                                    name="episode_number_selector" value="{{ old('episode_number_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="duration_selector" class="form-label">Duration Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="duration_selector" class="form-control"
                                    name="duration_selector" value="{{ old('duration_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="genre_selector" class="form-label">Genre Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="genre_selector" class="form-control" name="genre_selector"
                                    value="{{ old('genre_selector') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keyword_selector" class="form-label">Keyword Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="keyword_selector" class="form-control" name="keyword_selector"
                                    value="{{ old('keyword_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image_url_selector" class="form-label">Image URL Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="image_url_selector" class="form-control"
                                    name="image_url_selector" value="{{ old('image_url_selector') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="season_selector" class="form-label">Season Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="season_selector" class="form-control" name="season_selector"
                                    value="{{ old('season_selector') }}">
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Check
                            </button>
                        </div> --}}

                        <div class="mb-3">
                            <button class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Example Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="title" class="form-label">Post Url</label>
                            <input type="text" id="examplePost" class="form-control" name="url">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" onclick="checkData(event)">Check</button>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('js')
    <script>
function checkData(event) {
    event.preventDefault();

    let postUrl = encodeURIComponent($("#examplePost").val());
    let formData = $('#formAction').serialize();

    $.ajax({
        // url: "{{ route('dashboard.check_data') }}",
        type: 'GET',
        data: formData + "&postUrl=" + postUrl,
        success: function(response) {
            // Handle success response
            console.log(response);
            alert('Data submitted successfully!');
        },
        error: function(xhr) {
            // Handle error response
            console.error(xhr);
            alert('An error occurred while submitting the data.');
        }
    });
}

    </script>
@endsection --}}
