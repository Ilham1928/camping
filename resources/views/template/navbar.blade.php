<header class="header">
    <nav class="navbar">
        <div class="search-box">
            <button class="dismiss">
                <i class="icon-close"></i>
            </button>
            <form role="search">
                <input type="text" id="searchBar" placeholder="What are you looking for..." class="form-control">
            </form>
        </div>
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <a href="{{url('dashboard')}}" class="navbar-brand d-none d-sm-inline-block">
                        <div class="brand-text d-none d-lg-inline-block">
                            <strong>{{Session::get('brand')}}</strong>
                        </div>
                        <div class="brand-text d-none d-sm-inline-block d-lg-none">
                            <strong>{{Session::get('brand')}}</strong>
                        </div>
                    </a>
                    <a id="toggle-btn" href="onclick(window.location.replace('{{url('dashboard')}}'))" class="menu-btn active">
                        <span></span><span></span><span></span>
                    </a>
                </div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <li class="nav-item d-flex align-items-center">
                        <a id="search" href="#">
                            <i class="icon-search"></i>
                        </a>
                    </li>

                    <!-- logout -->
                    <li class="nav-item">
                        <a href="{{ url('logout') }}" class="nav-link logout">
                            <span class="d-none d-sm-inline">Logout</span>
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
