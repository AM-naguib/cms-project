<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='{{route('dashboard.index')}}'>


            <span class="align-middle me-3">{{getSettingS()->site_title}}</span>
        </a>

        <ul class="sidebar-nav">

            {{-- <li class="sidebar-header">
                posts
            </li> --}}
            <li class="sidebar-item">
                <a href="{{ route('dashboard.main-categories.index') }}" data-bs-target="#main-categories" class="sidebar-link ">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Main Categories</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('dashboard.categories.index') }}" data-bs-target="#categories" class="sidebar-link ">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Categories</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#posts" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Posts</span>
                </a>
                <ul id="posts" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='{{ route('dashboard.posts.index') }}'>All
                            Posts</a>
                    </li>
                    <li class="sidebar-item"><a class='sidebar-link' href='{{ route('dashboard.posts.create') }}'>Add
                            Post</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="sidebar-item">
                <a data-bs-target="#scraping_sites" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Scraping
                        Sites</span>
                </a>
                <ul id="scraping_sites" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link'
                            href='{{ route('dashboard.scraping_sites.index') }}'>All Sites</a>
                    </li>
                    <li class="sidebar-item"><a class='sidebar-link'
                            href='{{ route('dashboard.scraping_sites.create') }}'>Add Site</a>
                    </li>
                </ul>
            </li> --}}
            <li class="sidebar-item">
                <a href="{{ route('dashboard.years.index') }}" data-bs-target="#Years" class="sidebar-link ">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Years</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.genres.index') }}" data-bs-target="#Genres" class="sidebar-link ">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Genres</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.keywords.index') }}" data-bs-target="#keywords" class="sidebar-link ">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Keywords</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.settings.index') }}" data-bs-target="#settings" class="sidebar-link ">
                    <i class="align-middle" data-lucide="shopping-bag"></i> <span class="align-middle">Settings</span>
                </a>
            </li>



        </ul>


    </div>
</nav>
