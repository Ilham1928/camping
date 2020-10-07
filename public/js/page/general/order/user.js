var url = $('meta[name="__global_url"]').attr('content')

function detail(id) {
    $(window).attr('location', url+'/order-master/detail/'+id)
}

function checkout(id) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url+'/order-future/checkout?id='+id,
        beforeSend: function(){
            $('#btn-'+id).empty().append('Silakan Tunggu')
        },
        success: function(res){
            $('.error-message').css('display', 'none')
            if (res.code === 200) {
                $('#btn-'+id).empty().append('Checkout')
                $('#btn-'+id).attr('disabled', true)
                $('#myModal').modal('toggle')
            }else{
                $('.error-message').empty().append(res.message)
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

function reload() {
    window.location.reload()
}
