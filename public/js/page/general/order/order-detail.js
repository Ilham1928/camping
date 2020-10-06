var url = $('meta[name="__global_url"]').attr('content')

function update(id, type) {
    $('.span-rental-'+id).css('display', 'none')
    $('.span-qty-'+id).css('display', 'none')
    $('.input-rental-'+id).css('display', 'block')
    $('.input-qty-'+id).css('display', 'block')

    var contentRental = $('.span-rental-'+id).text().split(' ')
    var contentQTY = $('.span-qty-'+id).text()
    var content = id+','+"'"+ type +"'"

    $('.input-rental-'+id).val(contentRental[0])
    $('.input-qty-'+id).val(contentQTY)
    $('.btn').attr('disabled', true)
    $('#button-'+id).empty().append(
        '<button type="button" name="button" id="button-order" class="btn btn-primary btn-sm" onclick="save('+content+')">Simpan</button>'
        +'&nbsp;'
        +'<button type="button" name="button" class="btn btn-danger btn-sm" onclick="cancel('+content+')">Batal</button>'
        +'&nbsp;'
        +'<button type="button" disabled name="button" class="btn btn-success btn-sm" onclick="update('+content+')">Ubah</button>'
    )
}

function save(id, type) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: 'json',
        data: {
            'id' : id,
            'total_rental' : $('.input-rental-'+id).val(),
            'qty' : $('.input-qty-'+id).val(),
        },
        url: url + '/order-master/order-detail/update',
        beforeSend: function(){
            $('#button-order').empty().append('Silakan Tunggu...')
        },
        success: function(res){
            if (res.code == 200) {
                window.location.reload()
            }else{
                $('.error-message').empty().append(err.message)
                $('#button-order').empty().append('Simpan')
            }
        },
        statusCode: {
            500: function(err) {
                $('.error-message').empty().append(err.responseJSON.message)
            }
        }
    })
}

function cancel(id, type) {
    var content = id+','+"'"+ type +"'"

    $('.span-rental-'+id).css('display', 'block')
    $('.span-qty-'+id).css('display', 'block')
    $('.input-rental-'+id).css('display', 'none')
    $('.input-qty-'+id).css('display', 'none')
    $('.btn').attr('disabled', false)
    $('#button-'+id).empty().append(
        '<button type="button" name="button" class="btn btn-success btn-sm" onclick="update('+content+')">Ubah</button>'
    )
}
