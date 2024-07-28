@extends('dashboard.layout.app')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-8  col-12 mx-auto">
                <div class="card p-3">
                    <h1>Edit Site</h1>
                    <form action="{{ route('dashboard.scraping_sites.update', $scraping_site->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="site_name" class="form-label required">Site Name</label>
                            <input type="text" id="site_name" class="form-control" name="site_name" required
                                value="{{ $scraping_site->site_name }}">
                        </div>

                        <div class="mb-3">
                            <label for="site_url" class="form-label required">Site URL</label>
                            <input type="text" id="site_url" class="form-control" name="site_url" required
                                value="{{ $scraping_site->site_url }}">
                        </div>

                        <div class="mb-3">
                            <label for="title_selector" class="form-label">Title Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="title_selector" class="form-control" name="title_selector"
                                    value="{{ $scraping_site->title_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description_selector" class="form-label">Description Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="description_selector" class="form-control"
                                    name="description_selector" value="{{ $scraping_site->description_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="watch_urls_selector" class="form-label">Watch URLs Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="watch_urls_selector" class="form-control"
                                    name="watch_urls_selector" value="{{ $scraping_site->watch_urls_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="download_urls_selector" class="form-label">Download URLs Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="download_urls_selector" class="form-control"
                                    name="download_urls_selector" value="{{ $scraping_site->download_urls_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category_selector" class="form-label">Category Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="category_selector" class="form-control" name="category_selector"
                                    value="{{ $scraping_site->category_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quality_selector" class="form-label">Quality Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="quality_selector" class="form-control" name="quality_selector"
                                    value="{{ $scraping_site->quality_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="year_selector" class="form-label">Year Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="year_selector" class="form-control" name="year_selector"
                                    value="{{ $scraping_site->year_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="episode_number_selector" class="form-label">Episode Number Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="episode_number_selector" class="form-control"
                                    name="episode_number_selector" value="{{ $scraping_site->episode_number_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="duration_selector" class="form-label">Duration Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="duration_selector" class="form-control"
                                    name="duration_selector" value="{{ $scraping_site->duration_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="genre_selector" class="form-label">Genre Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="genre_selector" class="form-control" name="genre_selector"
                                    value="{{ $scraping_site->genre_selector }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keyword_selector" class="form-label">Keyword Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="keyword_selector" class="form-control" name="keyword_selector"
                                    value="{{ $scraping_site->keyword_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image_url_selector" class="form-label">Image URL Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="image_url_selector" class="form-control"
                                    name="image_url_selector" value="{{ $scraping_site->image_url_selector }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="season_selector" class="form-label">Season Selector</label>
                            <div class="d-flex gap-3">
                                <input type="text" id="season_selector" class="form-control" name="season_selector"
                                    value="{{ $scraping_site->season_selector }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")

<script>
    let category = $("#category");
    category.on("keyup", function() {
        let value = $(this).val();
        value = value.replace(/\s+/g, "-");
        value = value.replace(/^-+|-+$/g, "");
        $("#slug").val(value);
    });
</script>


@endsection
