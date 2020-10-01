<!DOCTYPE html>
<html>
    <head>
        <title>{{ Session::get('brand') }} | {{$title}}</title>
        @include('template.header')
        @yield('css')
    </head>
    <body>
        <div class="page">
            @include('template.navbar')
            <div class="page-content d-flex align-items-stretch">
                <!-- show menu config if uri segment 1 is menu -->
                @if(Request::segment(1) == 'menu')
                    @include('template.config')
                @else
                    @include('template.menu')
                @endif
                <div class="content-inner">
                    <br>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                    <footer class="main-footer" style="background:white">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </body>
    @include('template.footer')
    @yield('js')
</html>
