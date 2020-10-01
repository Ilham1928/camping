var url = $('meta[name="__global_url"]').attr('content')+'/admin-roles'

function getData(id) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        data: { role_id: id },
        url: url+'/get-permission',
        beforeSend: function(){
            $('#tableData tbody').empty().append(
                '<tr><td style="text-align:center" colspan="10">Please Wait ...</td></tr>'
            )
        },
        success: function(res){
            $('.error-message').css('display', 'none')
            if (res.code === 200) {
                $('#tableData tbody').html("")
                $(res.data.menu).each(function (index, item) {
                    $('#tableData tbody').append(
                        '<tr>'
                            +'<td>' + (parseInt, index+1) + '</td>'
                            +'<td colspan="10" style="font-weight:600;">' + item.menu_parent_name+ '</td>'
                        +'</tr>'
                    )
                    $(item.child).each(function(index, item){
                        var self = this
                        $('#tableData tbody').append(
                            '<tr id="'+ item.menu_child_id +'">'
                                +'<td></td>'
                                +'<td style="padding-left:25px">' + item.menu_child_name + '</td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_view_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_add_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_edit_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_delete_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_other_'+self.menu_child_id+'" class="checkbox-template"></td>'
                            +'</tr>'
                        )
                        if (res.data.permission.length !== 0) {
                            $(res.data.permission).each(function(index, item){
                                var checkedView = (item.menu_view === '1' && self.menu_child_id === item.menu_id) ? 'checked' : ''
                                var checkedAdd = (item.menu_add === '1' && self.menu_child_id === item.menu_id) ? 'checked' : ''
                                var checkedEdit = (item.menu_edit === '1' && self.menu_child_id === item.menu_id) ? 'checked' : ''
                                var checkedDelete = (item.menu_delete === '1' && self.menu_child_id === item.menu_id) ? 'checked' : ''
                                var checkedOther = (item.menu_other === '1' && self.menu_child_id === item.menu_id) ? 'checked' : ''
                                if (self.menu_child_id === item.menu_id) { // <--------------------- if data permission is empty
                                    $('#tableData tbody #'+self.menu_child_id ).empty().append(
                                            '<td></td>'
                                            +'<td style="padding-left:25px">' + self.menu_child_name + '</td>'
                                            +'<td style="padding-left:40px"><input ' +checkedView+ ' type="checkbox" onchange="save(this)" name="menu_view_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                            +'<td style="padding-left:40px"><input ' +checkedAdd+ ' type="checkbox" onchange="save(this)" name="menu_add_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                            +'<td style="padding-left:40px"><input ' +checkedEdit+ ' type="checkbox" onchange="save(this)" name="menu_edit_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                            +'<td style="padding-left:40px"><input ' +checkedDelete+ ' type="checkbox" onchange="save(this)" name="menu_delete_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                            +'<td style="padding-left:40px"><input ' +checkedOther+ ' type="checkbox" onchange="save(this)" name="menu_other_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                    )
                                }
                            })
                        }else{
                            $('#tableData tbody #'+self.menu_child_id).empty().append(
                                '<td></td>'
                                +'<td style="padding-left:25px">' + self.menu_child_name + '</td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_view_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_add_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_edit_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_delete_'+self.menu_child_id+'" class="checkbox-template"></td>'
                                +'<td style="padding-left:40px"><input type="checkbox" onchange="save(this)" name="menu_other_'+self.menu_child_id+'" class="checkbox-template"></td>'
                            )
                        }
                    })
                })
            }
        },
        error: function(err) {
            $('.error-message').empty().append(err.responseText)
            $('.error-message').css('display', 'block')
        }
    })
}

function save(permission) {
    var role_id = $('input[name=queue]').val()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type: 'GET',
        dataType: 'json',
        url: url+'/permission/'+role_id+'/save?param='+permission.name,
        success: function(data){
            if (data.code === 200) {
                $('.error-message').html("")
                $('.error-message').html(data.message)
                $('.error-message').css('display', 'block')
            }else{
                $('.error-message').empty().append(data.message)
                $('.error-message').css('display', 'block')
            }
        },
        error: function(err) {
            $('.error-message').empty().append(err.responseText)
            $('.error-message').css('display', 'block')
        }
    })
}
