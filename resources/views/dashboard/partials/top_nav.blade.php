<nav class="navbar navbar-expand navbar-bg">
    <a class="sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>



    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-lucide="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                    data-bs-toggle="dropdown">
                    <span>{{auth()->user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  <form action="{{route("logout")}}" method="post">
                    @csrf
                    <button class="btn w-100" >Logout</button>
                  </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
