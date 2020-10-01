<nav class="side-navbar">
    <div class="sidebar-header d-flex align-items-center">
        @php
            $default = 'https://icons-for-free.com/iconfiles/png/512/headset+male+man+support+user+young+icon-1320196267025138334.png';
            $photo = (!empty(Session::get('admin_photo'))) ? asset('storage/admin').'/'.Session::get('admin_photo') : asset('images/users').'/default.png';
        @endphp
        <div class="avatar"><img src="{{ $photo }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h4">{{ Session::get('admin_name') }}</h1>
            <p>{{ Session::get('admin_title') }}</p>
        </div>
    </div>
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="active">
            <a href="{{url('/dashboard')}}">
                <i class="fa fa-home"></i>
                Dashboard
            </a>
        </li>
        @if(Session::get('admin_role') != 1000)
            @foreach($menu as $parentMenu => $index)
                @if(!empty($index['child']))
                    <li class="">
                        <a href="#dropdown{{ $parentMenu }}" aria-expanded="" data-toggle="collapse">

                            <i class="demo-icon">{!! $index['icon']['menu_icon_unicode'] !!} </i>{{ $index['menu_parent_name'] }}
                        </a>
                        <ul id="dropdown{{ $parentMenu }}" class="collapse list-unstyled ">
                            @foreach($index['child'] as $child)
                                @if($child['status'] == 1)
                                    @php $activeList = (strpos($_SERVER['REQUEST_URI'], $child['menu_child_url']) == true) ? 'active' : ''; @endphp
                                    <li class=""><a href="{{ url($child['menu_child_url']) }}">{{ $child['menu_child_name'] }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        @else
            <li class="">
                <a href="#dropdown" aria-expanded="" data-toggle="collapse">
                    <i class="demo-icon">&#xe8ba;</i>Pesanan Saya
                </a>
                <ul id="dropdown" class="collapse list-unstyled ">
                    <li class=""><a href="{{ url('order-future') }}">Pesanan Akan Datang</a></li>
                    <li class=""><a href="{{ url('order-past') }}">Pesanan Berlalu</a></li>
                </ul>
            </li>
        @endif
    </ul>
</nav>
