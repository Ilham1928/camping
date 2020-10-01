var url     = $('meta[name="__global_url"]').attr('content')+'/menu/icon'

function getData(queryParam = false) {
    var query   = (queryParam) ? queryParam : '?page=1'
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url+'/data'+query,
        data: { paginate: true },
        beforeSend: function(){
            $('#tableData tbody').empty().append(
                '<tr><td style="text-align:center" colspan="10">Please Wait ...</td></tr>'
            )
        },
        success: function(res){
            console.log(res);
            $('.error-message').css('display', 'none')
            if (res.code === 200) {
                $('#tableData tbody').html("")
                $(res.data.data).each(function (index, item) {
                    var preview = '<i class="demo-icon">'+item.menu_icon_unicode+'</i>'
                    $('#tableData tbody').append(
                        '<tr>'
                            +'<td><input type="checkbox" name="check" onclick="selectData('+item.menu_icon_id+')" value="'+ item.menu_icon_id +'" class="checkbox-template"></td>'
                            +'<td>' + (parseInt, res.data.from+index) + '</td>'
                            +'<td>' + item.menu_icon_name + '</td>'
                            +'<td>' + item.menu_icon_class + '</td>'
                            +'<td>' + preview + '</td>'
                            +'<td>' + item.menu_icon_brand + '</td>'
                            +'<td>'
                                +'<button type="button" name="button" class="btn btn-success btn-sm" onclick="edit('+item.menu_icon_id+')">Edit</button>'
                                +'&nbsp'
                                +'<button type="button" name="button" class="btn btn-danger btn-sm" onclick="remove('+item.menu_icon_id+')">Delete</button>'
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

function save() {
    var params = {
            'menu_icon_name'  : $('input[name=menu_icon_name]').val(),
            'menu_icon_class' : $('input[name=menu_icon_class]').val(),
            'menu_icon_brand' : $('input[name=menu_icon_brand]').val(),
            'menu_icon_unicode' : $('input[name=menu_icon_unicode]').val()
        }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/save',
        data: params,
        success: function(data){
            console.log(data)
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

function clearForm() {
    $('.error-message').css('display', 'none')
}

function edit(id){
    $(window).attr('location', url+'/edit/'+id)
}

function update() {
    var id =  document.getElementById('queue').value
    var params = {
            'menu_icon_id'  : id,
            'menu_icon_name'  : $('input[name=menu_icon_name]').val(),
            'menu_icon_class' : $('input[name=menu_icon_class]').val(),
            'menu_icon_brand' : $('input[name=menu_icon_brand]').val(),
            'menu_icon_unicode' : $('input[name=menu_icon_unicode]').val()
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

function remove(id) {
    var params = { 'menu_icon_id'  : id }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        url: url+'/delete',
        data: params,
        success: function(data, err, xhr){
            if (data.code === 200) {
                $(window).attr('location', url)
            }else{
                $('.error-message').empty().append(data.message)
                $('.error-message').css('display', 'block')
            }
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
            data: { "menu_icon_id" : params },
            success: function(data, err, xhr){
                if (data.code === 200) {
                    $(window).attr('location', url)
                }else{
                    $('.error-message').empty().append(data.message)
                    $('.error-message').css('display', 'block')
                }
            }
        })
    })
}
