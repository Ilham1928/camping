var url = $('meta[name="__global_url"]').attr('content')+'/order-master'

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
                            +'<td>' + (parseInt, res.data.from+index) + '</td>'
                            +'<td>' + item.order_date + '</td>'
                            +'<td>' + item.order_code + '</td>'
                            +'<td>' + item.order_price + '</td>'
                            +'<td>' + item.order_type + '</td>'
                            +'<td>'
                                +'<button type="button" name="button" class="btn btn-warning btn-sm" onclick="detail('+item.order_id+')">Detail</button>'
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

function detail(id) {
    $(window).attr('location', url+'/detail/'+id)
}
