<!-- meta responsive -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="__global_url" content="{{ url('') }}">

<!-- css -->
    <!-- fonts -->
    <link rel="stylesheet" href="{{url('/css/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <link rel="stylesheet" href="{{url('/css/fonts/fontastic.css')}}">
    <link rel="stylesheet" href="{{url('/css/fonts/fontello.css')}}">

    <!-- skin -->
    <link rel="stylesheet" href="{{url('/css/skin/style.'.Session::get('skin').'.css')}}" id="theme-stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{url('/css/core/bootstrap.min.css')}}">

    <!-- index -->
    <link rel="stylesheet" href="{{url('/css/core/index.css')}}">
