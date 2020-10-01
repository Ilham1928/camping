var url = $('meta[name="__global_url"]').attr('content')

function auth() {
    var params = {
            'email' : $('input[name=email]').val(),
            'password'  : $('input[name=password]').val()
        }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/login',
        data: params,
        beforeSend: function(){
            $('#login').html('Please wait...')
        },
        success: function(data){
            if (data.code === 200) {
                $(window).attr('location', '/dashboard')
            }else{
                $('#login').html('Login')
                $('.error-message').empty().append(data.message)
                $('.error-message').css('display', 'block')
            }
        },
        error: function(err) {
            $('#login').html('Login')
            $('.error-message').empty().append(err.responseText)
            $('.error-message').css('display', 'block')
        }
    })
}
