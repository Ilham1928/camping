function selectIcon(id){
    var url = $('meta[name="__global_url"]').attr('content')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        data: { get: true },
        url: url+'/menu/parent/get-icon',
        success: function(res){
            console.log(res);
            if (res.code === 200) {
                $(res.data).each(function (index, item) {
                    var selected = (item.menu_icon_id === id) ? 'selected' : ''
                    var preview = '<option class="demo-icon"'+selected+' value="'+item.menu_icon_id+'">'+item.menu_icon_unicode+' '+item.menu_icon_name+'</option>'
                    $('#result-icon').append(preview)
                })
            }else{
                var preview = '<option value="" class="demo-icon">No Data</option>'
                $('#result-icon').empty().append(preview)
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

function selectParent(id) {
    var url = $('meta[name="__global_url"]').attr('content')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        url: url+'/menu/child/get-parent',
        success: function(res){
            if (res.code === 200) {
                $(res.data).each(function (index, item) {
                    var selected = (item.menu_parent_id === id) ? 'selected' : ''
                    var preview = '<option '+selected+' value="'+item.menu_parent_id+'">'+item.menu_parent_name+'</option>'
                    $('#select').append(preview)
                })
            }else{
                var preview = '<option value="">No Data</option>'
                $('#select').empty().append(preview)
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

function selectRole(id) {
    var url = $('meta[name="__global_url"]').attr('content')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        url: url+'/admin-master/get-roles',
        success: function(res){
            if (res.code === 200) {
                $(res.data).each(function (index, item) {
                    var selected = (item.role_id === id) ? 'selected' : ''
                    var preview = '<option '+selected+' value="'+item.role_id+'">'+item.role_name+'</option>'
                    $('#select').append(preview)
                })
            }else{
                var preview = '<option value="">No Data</option>'
                $('#select').empty().append(preview)
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

function selectCategory(id) {
    var url = $('meta[name="__global_url"]').attr('content')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        url: url+'/item-master/get-category',
        success: function(res){
            if (res.code === 200) {
                $(res.data).each(function (index, item) {
                    var selected = (item.category_id === id) ? 'selected' : ''
                    var preview = '<option '+selected+' value="'+item.category_id+'">'+item.category_name+'</option>'
                    $('#select').append(preview)
                })
            }else{
                var preview = '<option value="">No Data</option>'
                $('#select').empty().append(preview)
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
