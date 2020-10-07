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

                    var label = ''
                    if (item.is_cancel === 1) {
                        label = '<label style="color:red" class="col-sm-8">Dibatalkan</label>'
                    }else{
                        if (item.is_checkout === 1) {
                            if(item.total_price === 0){
                                label = '<label style="color:#796aee" class="col-sm-8">Menunggu Diproses</label>'
                            }else{
                                label = '<label style="color:green" class="col-sm-8">Diproses</label>'
                            }
                        }else{
                            label = '<label class="col-sm-8">Belum Checkout</label>'
                        }
                    }

                    var unit = (item.order_type === 'Pemandu') ? 'Orang' : 'Item'
                    var disabled = parseInt(item.total_price) > 0 ? 'disabled' : ''
                    var disableCacncel = parseInt(item.is_cancel) === 1 ? 'disabled' : ''

                    $('#tableData tbody').append(
                        '<tr>'
                            +'<td> <span id="'+ item.order_id +'" style="display:none">'+ item.total_price +'</span> ' + (parseInt, res.data.from+index) + '</td>'
                            +'<td>' + item.order_date + '</td>'
                            +'<td>' + item.order_code + '</td>'
                            +'<td>' + item.qty + ' ' + unit + '</td>'
                            +'<td>' + item.order_type + '</td>'
                            +'<td>' + label + '</td>'
                            +'<td>'
                                +'<button type="button" '+ disableCacncel + disabled +' name="button" class="btn btn-success btn-sm" onclick="getTotalPrice('+item.order_id+')">Proses</button>'
                                +'&nbsp'
                                +'<button type="button" '+ disableCacncel +' name="button" class="btn btn-warning btn-sm" onclick="detail('+item.order_id+')">Detail</button>'
                                +'&nbsp'
                                +'<button type="button" '+ disableCacncel + disabled +' name="button" class="btn btn-danger btn-sm" onclick="cancel('+item.order_id+')">Batalkan</button>'
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

function getTotalPrice(id) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url+'/total-price?id='+id,
        success: function(res){
            if (res.code == 200) {
                getForm(id, res.data)
            }else{
                getForm(id, 0)
            }
        }
    })
}

function getForm(id, totalPrice=false) {
    var price = $('#'+id).text()
    var selectedPay = parseInt(price) > 0 ? 'checked' : ''
    var selectedNotPay = parseInt(price) > 0 ? '' : 'checked'

    $('#myModal').modal('toggle')
    $('.modal-body').empty().append(
        '<form class="form-horizontal" id="form-order">'
            +'<center>'
                +'<p style="color:red" id="error-form"></p>'
            +'</center>'
            +'<div class="center">'
                +'<br>'
                +'<div class="row">'
                    +'<span class="input-material col-sm-12">'
                        +'<b>Total Yang Harus Dibayar : </b>'
                        +'<label style="color:red">Rp.'+ totalPrice.toLocaleString() +'</label>'
                    +'</span>'
                +'</div>'
                +'<br>'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                            +'<b>Lunas : </b>'
                            +'&nbsp;&nbsp;'
                            +'<input '+ selectedPay +' type="radio" disabled name="radio" class="radio-template"> Lunas'
                            +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                            +'<input '+ selectedNotPay +' type="radio" disabled name="radio" class="radio-template"> Belum Lunas'
                    +'</div>'
                +'</div>'
                +'<br>'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                            +'<b>Biaya yang di bayar : </b>'
                            +'<input type="number" id="total_price-'+ id +'" class="input-material col-sm-12">'
                    +'</div>'
                +'</div>'
                +'<br>'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                            +'<b>Keterangan : </b>'
                            +'<input type="text" id="note-'+ id +'" class="input-material col-sm-12" placeholder="opsional">'
                    +'</div>'
                +'</div>'
            +'</div>'
        +'</form>'
    )

    $('.modal-footer').empty().append(
         '<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>'
        +'<button type="button" onclick="process('+ id +')" id="button-order" class="btn btn-success">Proses</button>'
    )
}

function process(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/process',
        data: {
            id: id,
            total_price: $('#total_price-'+id).val(),
            note: $('#note-'+id).val()

        },
        success: function(res){
            if (res.code == '200') {
                window.location.reload()
            }else{
                $('#error-form').css('display', 'block')
                $('#error-form').empty().append(
                    res.message
                )
            }
        }
    })
}

function cancel(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type: 'POST',
        dataType: 'json',
        url: url+'/cancel',
        data: {
            id: id
        },
        success: function(res){
            if (res.code == '200') {
                window.location.reload()
            }else{
                $('.error-message').css('display', 'block')
                $('.error-message').empty().append(
                    res.message
                )
            }
        }
    })
}
