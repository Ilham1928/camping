var url = $('meta[name="__global_url"]').attr('content')+'/news-master'

function getData(queryParam = false) {
    var query   = (queryParam) ? queryParam : '?page=1'
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url+'/data'+query,
        beforeSend: function(){
            $('#tableData tbody').empty().append(
                '<tr><td style="text-align:center" colspan="10">Please Wait ...</td></tr>'
            )
        },
        success: function(res){
            $('.error-message').css('display', 'none')
            if (res.code === 200) {
                $('#tableData tbody').html("")
                $(res.data.data).each(function (index, item) {
                    $('#tableData tbody').append(
                        '<tr>'
                            +'<td><input type="checkbox" name="check" onclick="selectData('+item.news_id+')" value="'+ item.news_id +'" class="checkbox-template"></td>'
                            +'<td>' + (parseInt, res.data.from+index) + '</td>'
                            +'<td>' + item.news_title + '</td>'
                            +'<td>' + item.created_by + '</td>'
                            +'<td>' + item.created_at + '</td>'
                            +'<td>'
                                +'<button type="button" name="button" class="btn btn-warning btn-sm" onclick="detail('+item.news_id+')">Detail</button>'
                                +'&nbsp'
                                +'<button type="button" name="button" class="btn btn-success btn-sm" onclick="edit('+item.news_id+')">Edit</button>'
                                +'&nbsp'
                                +'<button type="button" name="button" class="btn btn-danger btn-sm" onclick="remove('+item.news_id+')">Delete</button>'
                            +'</td>'
                        +'</tr>'
                    )
                })
                $('.link').html(res.pagination)

            }else{
                $('#tableData tbody').empty().append(
                    '<tr><td style="text-align:center" colspan="10">No Data Available</td></tr>'
                )
            }
        },
        statusCode: {
            500: function(err) {
                $('.error-message').empty().append(err.responseJSON.message)
                $('.error-message').css('display', 'block')
            }
        }
    })
}

function save(file = false) {
    var params = {
        'news_title'    : $('input[name=news_title]').val(),
        'news_content'  : $('textarea#content').val(),
        'news_image'    : file
    }
    console.log(params);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/save',
        data: params,
        success: function(data){
            if (data.code === 200) {
                $(window).attr('location', url)
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

function clearForm() {
    $('.error-message').css('display', 'none')
}

function edit(id){
    $(window).attr('location', url+'/edit/'+id)
}

function update(file = false) {
    var id =  $('input[name=queue]').val()
    var params = {
            'news_id'       : id,
            'news_title'    : $('input[name=news_title]').val(),
            'news_content'  : $('textarea#content').val(),
            'news_image'    : file
        }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/update/'+id,
        data: params,
        success: function(data, err, xhr){
            if (data.code === 200) {
                $(window).attr('location', url)
            }else{
                $('.error-message').empty().append(data.message)
                $('.error-message').css('display', 'block')
            }
        },
        statusCode: {
            500: function(err) {
                $('.error-message').empty().append(err.responseJSON.message)
                $('.error-message').css('display', 'block')
            }
        }
    })
}

function uploadFile(forUpdate=false) {
    if ($("#photo").prop('files').length > 0) {
        var filesAmount = $("#photo").prop('files').length;
        for (var i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function(reader) {

                if (forUpdate) {
                    update(reader.target.result)
                }else{
                    save(reader.target.result)
                }

                var element = '<div class="images" onclick="removeImage()">'
                                +'<img src="'+reader.target.result+'" class="upload-preview" />'
                                +'<i class="demo-icon remove-image">&#xe88d;</i>'
                              +'</div>'

                $(element).appendTo('.preview')

                $('.images').css('display', 'block')
                $('.dropzone-desc').css('display', 'none')
            }

            reader.readAsDataURL($("#photo").prop('files')[0]);
        }
    }
}

function removeImage() {
    $('.images').remove()
    if ($('.preview div').length < 1) {
        $('.dropzone-desc').css('display', 'block')
    }
}

function detail(id) {
    $(window).attr('location', url+'/detail/'+id)
}

function remove(id) {
    var params = { 'news_id'  : id }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        url: url+'/delete',
        data: params,
        success: function(data){
            if (data.code === 200) {
                $(window).attr('location', url)
            }else{
                $('.error-message').empty().append(data.message)
                $('.error-message').css('display', 'block')
            }
        },
        error: function(err){
            $('.error-message').empty().append(err.responseText)
            $('.error-message').css('display', 'block')
        }
    })
}

function selectAll(){
    var query = []
    if($('#checkbox-parent').prop('checked')){
        $('tbody tr td input[type="checkbox"]').each(function(){
            $(this).prop('checked', true)
            query.push(this.value)
            $('#bulkDelete').css('display', '')
        })
    }else{
        $('tbody tr td input[type="checkbox"]').each(function(){
            $(this).prop('checked', false)
            $('#bulkDelete').css('display', 'none')
        })
    }
    this.bulkDelete(query)
}

function selectData() {
    var query = []
    $('input[name="check"]:checked').each(function(){ query.push(this.value) })

    if (query.length > 1) {
        $('#bulkDelete').css('display', '')
    }else{
        $('#bulkDelete').css('display', 'none')
    }
    this.bulkDelete(query)
}

function bulkDelete(params) {
    $('#bulkDelete').click(function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            dataType: 'json',
            url: url+'/delete/many',
            data: { "news_id" : params },
            success: function(data, err, xhr){
                if (data.code === 200) {
                    $(window).attr('location', url)
                }else{
                    $('.error-message').empty().append(data.message)
                    $('.error-message').css('display', 'block')
                }
            },
            error: function(err){
                $('.error-message').empty().append(err.responseJSON.message)
                $('.error-message').css('display', 'block')
            }
        })
    })
}
