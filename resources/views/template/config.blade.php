<nav class="side-navbar">
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="https://icons-for-free.com/iconfiles/png/512/headset+male+man+support+user+young+icon-1320196267025138334.png" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h4">Mark Stephen</h1>
            <p>Web Designer</p>
        </div>
    </div>
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        @php $cms = (Request::is('menu/config*')) ? 'active' : ''; @endphp
        <li class="{{ $cms }}">
            <a href="{{url('menu/config')}}">
                <i class="fa fa-desktop"></i>
                Cms Config
            </a>
        </li>
        @php $icon = (Request::is('menu/icon*')) ? 'active' : ''; @endphp
        <li class="{{ $icon }}">
            <a href="{{url('menu/icon')}}">
                <i class="fa fa-heart-o"></i>
                Menu Icon
            </a>
        </li>
        @php $parent = (Request::segment('2') == 'parent' ) ? 'active' : ''; @endphp
        <li class="{{ $parent }}">
            <a href="{{url('menu/parent')}}">
                <i class="fa fa-sliders"></i>
                Menu Parent
            </a>
        </li>
        @php $child = (Request::segment('2') == 'child' ) ? 'active' : ''; @endphp
        <li class="{{ $child }}">
            <a href="{{url('menu/child')}}">
                <i class="fa fa-bars"></i>
                Menu Child
            </a>
        </li>
    </ul>
</nav>
