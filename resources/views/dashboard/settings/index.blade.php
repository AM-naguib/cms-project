@extends('dashboard.layout.app')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-8  col-12 mx-auto">
                <div class="card p-3">
                    <h1>Settings</h1>
                    <form action="{{ route('dashboard.settings.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="site_title" class="form-label">Site Title</label>
                            <input type="text" id="site_title" class="form-control" name="site_title"
                                value="{{ $settings->site_title ?? '' }}">
                            @if ($errors->has('site_title'))
                                <span class="text-danger">{{ $errors->first('site_title') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="site_description" class="form-label">Site Description</label>
                            <input type="text" id="site_description" class="form-control" name="site_description"
                                value="{{ $settings->site_description ?? '' }}">
                            @if ($errors->has('site_description'))
                                <span class="text-danger">{{ $errors->first('site_description') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="site_keywords" class="form-label">Site Keywords</label>
                            <textarea name="site_keywords" class="form-control" id="site_keywords">{{ $settings->site_keywords ?? '' }}</textarea>
                            @if ($errors->has('site_keywords'))
                                <span class="text-danger">{{ $errors->first('site_keywords') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="auto_scraping" class="form-label">Auto Scraping</label>
                            <select name="auto_scraping" onchange="" id="auto_scraping" class="form-control">
                                <option @if ($settings->auto_scraping == '0') selected @endif value="0">OFF</option>
                                <option @if ($settings->auto_scraping == '1') selected @endif value="1">ON</option>
                            </select>
                        </div>

                        <div id="containerr">

                        </div>

                        <div class="mb-3">
                            <label for="slide_show" class="form-label">Show Slider</label>
                            <select name="slide_show" id="slide_show" class="form-control">
                                <option @if ($settings->slide_show == 0) selected @endif value="0">OFF</option>
                                <option @if ($settings->slide_show == 1) selected @endif value="1">ON</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="site_favicon" class="form-label">Site Favicon</label>
                            <div class="row d-flex align-items-center ">
                                <div class="img col-1">
                                    @if (!empty($settings->site_favicon))
                                        <img src="../../storage/{{ $settings->site_favicon }}" alt="site_favicon"
                                            width="50" height="50">
                                    @endif

                                </div>
                                <div class="input @if (empty($settings->site_favicon)) col-12 @else col-11 @endif">
                                    <input type="file" id="site_favicon" class="form-control" name="site_favicon">
                                    @if ($errors->has('site_favicon'))
                                    <span class="text-danger">{{ $errors->first('site_favicon') }}</span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="site_logo" class="form-label">Site Logo</label>
                            <div class="row d-flex align-items-center ">
                                <div class="img col-1">
                                    @if (!empty($settings->site_logo))
                                        <img src="../../storage/{{ $settings->site_logo }}" alt="site_logo" width="50"
                                            height="50">
                                    @endif
                                </div>
                                <div class="input @if (empty($settings->site_logo)) col-12 @else col-11 @endif">
                                    <input type="file" id="site_logo" class="form-control" name="site_logo">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="header_ads" class="form-label">Header Ads</label>
                            <textarea name="header_ads" class="form-control" id="header_ads">{{ $settings->header_ads ?? '' }}</textarea>
                            @if ($errors->has('header_ads'))
                                <span class="text-danger">{{ $errors->first('header_ads') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="footer_ads" class="form-label">Fotter Ads</label>
                            <textarea name="footer_ads" class="form-control" id="footer_ads">{{ $settings->footer_ads ?? '' }}</textarea>
                            @if ($errors->has('footer_ads'))
                                <span class="text-danger">{{ $errors->first('footer_ads') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="single_ads" class="form-label">Single Ads</label>
                            <textarea name="single_ads" class="form-control" id="single_ads">{{ $settings->single_ads ?? '' }}</textarea>
                            @if ($errors->has('single_ads'))
                                <span class="text-danger">{{ $errors->first('single_ads') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function sitesHtml() {
            return `                            <div class="mb-3" id="scraping_site_container">
                                <label for="scraping_site" class="form-label">Scraping Site</label>
                                <select name="scraping_site" id="scraping_site" class="form-control">
                                    <option @if ($settings->scraping_site == 'tuktukcinema') selected @endif value="tuktukcinema">Tuktuk
                                        Cinema</option>
                                </select>
                            </div>`
        }
        $(document).ready(function() {


            if ($('#auto_scraping').val() == 1) {
                $("#containerr").html(sitesHtml())
            }
            $('#auto_scraping').on('change', function() {
                if ($(this).val() == '0') {
                    $('#scraping_site_container').remove();
                } else {
                    $("#containerr").html(sitesHtml())
                }
            });
        });
    </script>
@endsection
