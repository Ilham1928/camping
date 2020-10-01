var url = $('meta[name="__global_url"]').attr('content')

function signin() {
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

function signup() {
    var params = $('#signup-form').serializeArray();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/register',
        data: params,
        beforeSend: function(){
            $('#register').html('Please wait...')
        },
        success: function(data){
            if (data.code === 200) {
                $('#register-div').css('display', 'none')
                $('#login-div').css('display', 'block')
                $('.error-message').css('display', 'block')
                $('.error-message').empty().append('Berhasil Daftar! silahkan login.')
                $('#signup-form').trigger('reset')
                $('#register').html('Register')
            }else{
                $('#register').html('Register')
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

function getFormRegister() {
    $('#register-div').css('display', 'block')
    $('#login-div').css('display', 'none')
}

function getFormLogin() {
    $('#register-div').css('display', 'none')
    $('#login-div').css('display', 'block')
}
