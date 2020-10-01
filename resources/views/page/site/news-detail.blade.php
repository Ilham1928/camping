<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="__global_url" content="{{ url('') }}">
    <title>{{ $title }}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/page/site/news-detail-style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="well">
        <div class="row" id="article-content">

        </div>
    </div>
    <section class="content-item" id="comments">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <center>
                        <p class="error-message" style="display:none; background-color:#ff0000c2; color:white; padding:10px"></p>
                    </center>
                    <form>
                        <h3 class="pull-left">New Comment</h3>
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-3 col-lg-2 hidden-xs">
                                    <img class="img-responsive" src="{{ asset('images/users/default.png') }}" alt="">
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <input class="form-control" id="name" placeholder="Your name" required=""></input>
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <input class="form-control" id="email" placeholder="Your email" required=""></input>
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <textarea class="form-control" id="comment" placeholder="Your message" required=""></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <button type="button" onclick="setComment({{ Request::segment(3) }})" class="btn btn-normal pull-right">Submit</button>
                    </form>
                    <div id="content"></div>
                </div>
            </div>
        </div>
    </section>
</body>
<footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/page/general/site/news/news.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        this.getContent({{ Request::segment(3) }})
    </script>
</footer>
</html>
