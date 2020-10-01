var url  = $('meta[name="__global_url"]').attr('content')+'/menu/config'

function update() {
    var id =  $('#queue').val()
    var params = {
            'cms_config_id'  : id,
            'cms_config_brand'  : $('input[name=cms_config_brand]').val(),
            'cms_config_skin' : $('input[name=cms_config_skin]:checked').val(),
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
