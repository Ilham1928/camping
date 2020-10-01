<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="__global_url" content="{{ url('') }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/page/site/news-style.css') }}">
</head>
<body>
    <div class="article-list">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Latest News</h2>
                <p class="text-center">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                </p>
            </div>
            <div class="row articles" id="content"></div>
        </div>
    </div>
</body>
<footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/page/general/site/news/news.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        this.getData()
    </script>
</footer>
</html>
