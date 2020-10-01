var url = $('meta[name="__global_url"]').attr('content')

function getData(queryParam = false) {
    var query   = (queryParam) ? queryParam : '?page=1'
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url+'/api/news'+query,
        beforeSend: function(){
            $('#content').empty().append(
                '<div class="col-sm-12 col-md-12 item">'+
                    '<img width="100" src="'+ url +'/css/page/site/800.gif" alt="">'+
                    '<br><br>'+
                    '<strong>Please Wait</strong>'+
                '</div>'
            )
        },
        success: function(res){
            if (res.code === 200) {
                $('#content').html("")
                $(res.data.data).each(function (index, item) {
                    $('#content').append(
                        '<div class="col-sm-6 col-md-4 item" style="cursor:pointer">'
                            +'<a onclick="detail('+ item.news_id +')">'
                                +'<img class="img-fluid" src="'+url+'/storage/news/'+ item.news_image +'">'
                            +'</a>'
                            +'<h3 class="name">'+ item.news_title +'</h3>'
                            +'<p class="description">'+ item.news_content.substring(0, 100) +'...</p>'
                            +'<a onclick="detail('+ item.news_id +')" class="action">'
                                +'<i class="fa fa-arrow-circle-right"></i>'
                            +'</a>'
                        +'</div>'
                    )
                })

            }else{
                $('#content').empty().append(
                    '<div class="col-sm-12 col-md-12 item">'+
                        '<br><br>'+
                        '<strong>No News Found</strong>'+
                    '</div>'
                )
            }
        }
    })
}

function detail(id) {
    $(window).attr('location', url+'/news/detail/'+id)
}

function getContent(id, totalComment = null) {
    $.ajax({
        type: 'PUT',
        dataType: 'json',
        url: url+'/api/news/detail',
        data: { 'news_id' : id },
        success: function(res){
            if (res.code === 200) {
                $('#article-content').html("")
                $('#article-content').append(
                    '<div class="col-md-12">'
                        +'<div class="row hidden-md hidden-lg">'
                            +'<h1 class="text-center">'+ res.data.news_title +'</h1>'
                        +'</div>'
                        +'<div class="pull-left col-md-4 col-xs-12 thumb-contenido">'
                            +'<img class="center-block img-responsive" width="500" src="'+url+'/storage/news/'+ res.data.news_image +'">'
                        +'</div>'
                        +'<div class="">'
                            +'<h1 class="hidden-xs hidden-sm">'+ res.data.news_title +'</h1>'
                            +'<hr>'
                            +'<small>'+ res.data.created_at +'</small><br>'
                            +'<small><strong>Admin - '+ res.data.created_by +'</strong></small>'
                            +'<hr>'
                            +'<p class="text-justify">'+ res.data.news_content +'</p>'
                        +'</div>'
                    +'</div>'
                )

                if (res.data.comment.length > 0) {
                    $(res.data.comment).each(function (index, item) {
                        var date = new Date(item.created_at)

                        $('#content').append(
                            '<div class="media">'
                                +'<a class="pull-left" href="#">'
                                    +'<img class="media-object" src="'+url+'/images/users/default.png">'
                                +'</a>'
                                +'<div class="media-body">'
                                    +'<h4 class="media-heading">'+ item.comment_name +' | '+ item.comment_email +'</h4>'
                                    +'<p>'+ item.comment_content +'</p>'
                                    +'<ul class="list-unstyled list-inline media-detail pull-left">'
                                        +'<li><i class="fa fa-calendar"></i>'+ date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear() +'</li>'
                                    +'</ul>'
                                +'</div>'
                            +'</div>'
                        )
                    })
                }
            }else{
                $(window).attr('location', url+'/news')
            }
        }
    })
}

function setComment(id) {
    var params = {
        'news_id' : id,
        'name'    : $('#name').val(),
        'email'   : $('#email').val(),
        'comment' : $('textarea#comment').val(),
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/api/news/comment',
        data: params,
        success: function(data){
            if (data.code === 200) {
                var date = new Date
                $('#content').append(
                    '<div class="media">'
                        +'<a class="pull-left" href="#">'
                            +'<img class="media-object" src="'+url+'/images/users/default.png">'
                        +'</a>'
                        +'<div class="media-body">'
                            +'<h4 class="media-heading">'+ params.name +' | '+ params.email +'</h4>'
                            +'<p>'+ params.comment +'</p>'
                            +'<ul class="list-unstyled list-inline media-detail pull-left">'
                                +'<li><i class="fa fa-calendar"></i>'+ date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear() +'</li>'
                            +'</ul>'
                        +'</div>'
                    +'</div>'
                )
                $('#name').val('')
                $('#email').val('')
                $('textarea#comment').val('')
            }else{
                $('.error-message').empty().append(data.message)
                $('.error-message').css('display', 'block')
            }
        },
        error: function(err) {
            $('.error-message').empty().append(err.responseJSON.message)
            $('.error-message').css('display', 'block')
        }
    })
}
