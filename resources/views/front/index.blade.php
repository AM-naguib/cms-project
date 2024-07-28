@extends('front.layout.app')
@section("content")
	<!-- home -->
	<section class="home home--bg">
		<div class="container">
			<div class="row">
				<!-- home title -->
				<div class="col-12">
					<h1 class="home__title"><b>NEW ITEMS</b> OF THIS SEASON</h1>
				</div>
				<!-- end home title -->

				<!-- home carousel -->
				<div class="col-12">
					<div class="home__carousel splide splide--home">
						<div class="splide__arrows">
							<button class="splide__arrow splide__arrow--prev" type="button">
								<i class="ti ti-chevron-left"></i>
							</button>
							<button class="splide__arrow splide__arrow--next" type="button">
								<i class="ti ti-chevron-right"></i>
							</button>
						</div>

						<div class="splide__track">
							<ul class="splide__list">
								<li class="splide__slide">
									<div class="item item--hero">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover12.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">8.4</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">The Edge of Tomorrow</a></h3>
											<span class="item__category">
												<a href="#">Action</a>
												<a href="#">Triler</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--hero">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover2.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">7.1</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Benched</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--hero">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover8.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">7.9</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Green Hell</a></h3>
											<span class="item__category">
												<a href="#">Romance</a>
												<a href="#">Drama</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--hero">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover9.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--yellow">6.8</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Survival Spliton</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
												<a href="#">Drama</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--hero">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover13.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">9.1</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">The Chebod</a></h3>
											<span class="item__category">
												<a href="#">Drama</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--hero">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover5.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--yellow">6.7</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Shadow</a></h3>
											<span class="item__category">
												<a href="#">Drama</a>
											</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end home carousel -->
			</div>
		</div>
	</section>
	<!-- end home -->

	<!-- filter -->
	<div class="filter">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="filter__content">
						<!-- menu btn -->
						<button class="filter__menu" type="button"><i class="ti ti-filter"></i>Filter</button>
						<!-- end menu btn -->

						<!-- filter desk -->
						<div class="filter__items">
							<select class="filter__select" name="genre" id="filter__genre">
								<option value="0">All genres</option>
								<option value="1">Action/Adventure</option>
								<option value="2">Animals</option>
								<option value="3">Animation</option>
								<option value="4">Biography</option>
								<option value="5">Comedy</option>
								<option value="6">Cooking</option>
								<option value="7">Dance</option>
								<option value="8">Documentary</option>
								<option value="9">Drama</option>
								<option value="10">Education</option>
								<option value="11">Entertainment</option>
								<option value="12">Family</option>
								<option value="13">Fantasy</option>
								<option value="14">History</option>
								<option value="15">Horror</option>
								<option value="16">Independent</option>
								<option value="17">International</option>
								<option value="18">Kids</option>
								<option value="19">Medical</option>
								<option value="20">Military/War</option>
								<option value="21">Music</option>
								<option value="22">Mystery/Crime</option>
								<option value="23">Nature</option>
								<option value="24">Paranormal</option>
								<option value="25">Politics</option>
								<option value="26">Racing</option>
								<option value="27">Romance</option>
								<option value="28">Sci-Fi/Horror</option>
								<option value="29">Science</option>
								<option value="30">Science Fiction</option>
								<option value="31">Science/Nature</option>
								<option value="32">Spanish</option>
								<option value="33">Travel</option>
								<option value="34">Western</option>
							</select>

							<select class="filter__select" name="quality" id="filter__quality">
								<option value="0">Any quality</option>
								<option value="1">HD 1080</option>
								<option value="2">HD 720</option>
								<option value="3">DVD</option>
								<option value="4">TS</option>
							</select>

							<select class="filter__select" name="rate" id="filter__rate">
								<option value="0">Any rating</option>
								<option value="1">from 3.0</option>
								<option value="2">from 5.0</option>
								<option value="3">from 7.0</option>
								<option value="4">Golder Star</option>
							</select>

							<select class="filter__select" name="sort" id="filter__sort">
								<option value="0">Relevance</option>
								<option value="1">Newest</option>
								<option value="2">Oldest</option>
							</select>
						</div>
						<!-- end filter desk -->

						<!-- filter btn -->
						<button class="filter__btn" type="button">Apply</button>
						<!-- end filter btn -->

						<!-- amount -->
						<span class="filter__amount">Showing 18 of 1713</span>
						<!-- end amount -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end filter -->
	<!-- catalog -->
	<div class="section section--catalog">
		<div class="container">
			<div class="row">
                @forelse ($posts as $post)
				<!-- item -->
				<div class="col-6 col-sm-4 col-lg-4 col-xl-3">
					<div class="item">
						<div class="item__cover">
							<img src="storage/{{ $post->image_url }}" alt="">
							<a href="details.html" class="item__play">
								<i class="ti ti-player-play-filled"></i>
							</a>
							<span class="item__rate item__rate--green">8.4</span>
							<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
						</div>
						<div class="item__content">
							<h3 class="item__title"><a href="details.html">{{ $post->title }}</a></h3>
							<span class="item__category">
                                @forelse ($post->genres as $genre)
								<a href="#">{{$genre->name}}</a>
                                @empty
                                @endforelse
							</span>
						</div>
					</div>
				</div>
				<!-- end item -->

                @empty
                    <h2>no posts</h2>
                @endforelse

			</div>

			<div class="row">
				<!-- paginator -->
				<div class="col-12">
					<!-- paginator mobile -->
					<div class="paginator-mob">
						<span class="paginator-mob__pages">18 of 1713</span>

						<ul class="paginator-mob__nav">
							<li>
								<a href="#">
									<i class="ti ti-chevron-left"></i>
									<span>Prev</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>Next</span>
									<i class="ti ti-chevron-right"></i>
								</a>
							</li>
						</ul>
					</div>
					<!-- end paginator mobile -->

					<!-- paginator desktop -->
					<ul class="paginator">
						<li class="paginator__item paginator__item--prev">
							<a href="#"><i class="ti ti-chevron-left"></i></a>
						</li>
						<li class="paginator__item"><a href="#">1</a></li>
						<li class="paginator__item paginator__item--active"><a href="#">2</a></li>
						<li class="paginator__item"><a href="#">3</a></li>
						<li class="paginator__item"><a href="#">4</a></li>
						<li class="paginator__item"><span>...</span></li>
						<li class="paginator__item"><a href="#">87</a></li>
						<li class="paginator__item paginator__item--next">
							<a href="#"><i class="ti ti-chevron-right"></i></a>
						</li>
					</ul>
					<!-- end paginator desktop -->
				</div>
				<!-- end paginator -->
			</div>
		</div>
	</div>
	<!-- end catalog -->

	<!-- section -->
	<section class="section section--border">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<div class="section__title-wrap">
						<h2 class="section__title">Expected premiere</h2>
						<a href="catalog.html" class="section__view section__view--carousel">View All</a>
					</div>
				</div>
				<!-- end section title -->

				<!-- carousel -->
				<div class="col-12">
					<div class="section__carousel splide splide--content">
						<div class="splide__arrows">
							<button class="splide__arrow splide__arrow--prev" type="button">
								<i class="ti ti-chevron-left"></i>
							</button>
							<button class="splide__arrow splide__arrow--next" type="button">
								<i class="ti ti-chevron-right"></i>
							</button>
						</div>

						<div class="splide__track">
							<ul class="splide__list">
								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">8.4</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">I Dream in Another Language</a></h3>
											<span class="item__category">
												<a href="#">Action</a>
												<a href="#">Triler</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover2.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">7.1</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Benched</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover3.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--red">6.3</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Whitney</a></h3>
											<span class="item__category">
												<a href="#">Romance</a>
												<a href="#">Drama</a>
												<a href="#">Music</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover4.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--yellow">6.9</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Blindspotting</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
												<a href="#">Drama</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover5.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">8.4</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">I Dream in Another Language</a></h3>
											<span class="item__category">
												<a href="#">Action</a>
												<a href="#">Triler</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover6.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">7.1</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Benched</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover7.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">7.1</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Benched</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover8.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--red">5.5</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">I Dream in Another Language</a></h3>
											<span class="item__category">
												<a href="#">Action</a>
												<a href="#">Triler</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover9.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--yellow">6.7</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Blindspotting</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
												<a href="#">Drama</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover10.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--red">5.6</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Whitney</a></h3>
											<span class="item__category">
												<a href="#">Romance</a>
												<a href="#">Drama</a>
												<a href="#">Music</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover11.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">9.2</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">Benched</a></h3>
											<span class="item__category">
												<a href="#">Comedy</a>
											</span>
										</div>
									</div>
								</li>

								<li class="splide__slide">
									<div class="item item--carousel">
										<div class="item__cover">
											<img src="{{asset('front')}}/img/covers/cover12.jpg" alt="">
											<a href="details.html" class="item__play">
												<i class="ti ti-player-play-filled"></i>
											</a>
											<span class="item__rate item__rate--green">8.4</span>
											<button class="item__favorite" type="button"><i class="ti ti-bookmark"></i></button>
										</div>
										<div class="item__content">
											<h3 class="item__title"><a href="details.html">I Dream in Another Language</a></h3>
											<span class="item__category">
												<a href="#">Action</a>
												<a href="#">Triler</a>
											</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end carousel -->
			</div>
		</div>
	</section>
	<!-- end section -->

	<!-- mobile filter -->
	<div class="mfilter">
		<div class="mfilter__head">
			<h6 class="mfilter__title">Filter</h6>

			<button class="mfilter__close" type="button"><i class="ti ti-x"></i></button>
		</div>

		<div class="mfilter__select-wrap">
			<div class="sign__group">
				<select class="filter__select" name="mgenre" id="mfilter__genre">
					<option value="0">All genres</option>
					<option value="1">Action/Adventure</option>
					<option value="2">Animals</option>
					<option value="3">Animation</option>
					<option value="4">Biography</option>
					<option value="5">Comedy</option>
					<option value="6">Cooking</option>
					<option value="7">Dance</option>
					<option value="8">Documentary</option>
					<option value="9">Drama</option>
					<option value="10">Education</option>
					<option value="11">Entertainment</option>
					<option value="12">Family</option>
					<option value="13">Fantasy</option>
					<option value="14">History</option>
					<option value="15">Horror</option>
					<option value="16">Independent</option>
					<option value="17">International</option>
					<option value="18">Kids</option>
					<option value="19">Medical</option>
					<option value="20">Military/War</option>
					<option value="21">Music</option>
					<option value="22">Mystery/Crime</option>
					<option value="23">Nature</option>
					<option value="24">Paranormal</option>
					<option value="25">Politics</option>
					<option value="26">Racing</option>
					<option value="27">Romance</option>
					<option value="28">Sci-Fi/Horror</option>
					<option value="29">Science</option>
					<option value="30">Science Fiction</option>
					<option value="31">Science/Nature</option>
					<option value="32">Spanish</option>
					<option value="33">Travel</option>
					<option value="34">Western</option>
				</select>
			</div>

			<div class="sign__group">
				<select class="filter__select" name="mquality" id="mfilter__quality">
					<option value="0">Any quality</option>
					<option value="1">HD 1080</option>
					<option value="2">HD 720</option>
					<option value="3">DVD</option>
					<option value="4">TS</option>
				</select>
			</div>

			<div class="sign__group">
				<select class="filter__select" name="mrate" id="mfilter__rate">
					<option value="0">Any rating</option>
					<option value="1">from 3.0</option>
					<option value="2">from 5.0</option>
					<option value="3">from 7.0</option>
					<option value="4">Golder Star</option>
				</select>
			</div>

			<div class="sign__group">
				<select class="filter__select" name="msort" id="mfilter__sort">
					<option value="0">Relevance</option>
					<option value="1">Newest</option>
					<option value="2">Oldest</option>
				</select>
			</div>
		</div>

		<button class="mfilter__apply" type="button">Apply</button>
	</div>
	<!-- end mobile filter -->

@endsection
