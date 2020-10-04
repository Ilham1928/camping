var url = $('meta[name="__global_url"]').attr('content')

function detail(type, id) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        data: {
            'id' : id,
            'type' : type
        },
        url: url + '/dashboard/detail-item',
        beforeSend: function(){
            $('#myModal').modal('toggle')
            $('.modal-footer').empty().append('<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>')
            $('.modal-content').css('width', '100%')
            $('.modal-body').empty().append(
                '<p>Silakan Tunggu ...</p>'
            )
        },
        success: function(res){
            if (res.code === 200) {
                $('.modal-footer').empty().append('<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>')
                $('.modal-body').html("")
                $('.modal-content').css('width', 'fit-content')
                if (type === 'item') {
                    $('.modal-body').empty().append(
                        '<img style="padding:10px" src="' + url + '/storage/item/' + res.data.item_image +'" />'
                        +'<p>'
                            +'<b id="item">Nama Barang</b> : ' + res.data.item_name + '</br>'
                            +'<b>Kategori Barang</b> : ' + res.data.category.category_name + '</br>'
                            +'<b>Harga Sewa</b> : <span style="color:red"> Rp.' + (res.data.item_price).toLocaleString() + ' per hari</span></br>'
                            +'<b>Deskripsi</b> : ' + res.data.item_description + '</br>'
                        +'</p>'
                    )
                }

                if (type === 'guide') {
                    var date = new Date()
                    var birthday = res.data.guide_birthday.split('-')
                    var age = parseInt(date.getFullYear()) - parseInt(birthday[0])
                    $('.modal-body').empty().append(
                        '<img style="padding:10px" src="' + url + '/storage/guide/' + res.data.guide_photo +'" />'
                        +'<p style="padding-left:10px">'
                            +'<b>Nama Pemandu</b> : ' + res.data.guide_name + '</br>'
                            +'<b>Jenis Kelamin</b> : ' + res.data.guide_gender + '</br>'
                            +'<b>Usia</b> : ' + age + ' Tahun </br>'
                            +'<b>Harga Sewa</b> : <span style="color:red"> Rp.' + (res.data.guide_price).toLocaleString() + ' per hari</span></br>'
                            +'<b>Pengalaman</b> : ' + res.data.guide_experience + ' Tahun</br>'
                        +'</p>'
                    )
                }

            }else{
                $('.modal-body').empty().append(
                    '<p>Ada kesalahan server...</p>'
                )
            }
        },
        statusCode: {
            500: function(err) {
                $('.modal-body').empty().append(
                    '<p>'+ err.responseJSON.message +'</p>'
                )
            }
        }
    })
}

function getForm(type, id, name) {
    var cart = "'" + type + "'" + "," + id
    var tipe = (type === 'guide') ? 'Pemandu' : 'Alat Camping'
    $('#myModal').modal('toggle')
    $('.modal-content').css('width', '100%')
    $('.modal-footer').empty().append(
         '<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>'
        +'<button type="button" onclick="addToCart('+ cart +')" id="button-order" class="btn btn-success">Sewa</button>'
    )
    $('.modal-body').empty().append(
        '<form class="form-horizontal" id="form-order">'
            +'<p class="error-message"></p>'
            +'<div class="center">'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                        +'<input type="text" readonly class="input-material col-sm-12" value="'+ name +'">'
                        +'<b>Nama Item</b>'
                    +'</div>'
                +'</div>'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                        +'<input type="text" readonly="readonly" class="input-material col-sm-12" value="'+ tipe +'">'
                        +'<b>Tipe Item</b>'
                    +'</div>'
                +'</div>'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                        +'<input type="number" name="total_rental" class="input-material col-sm-12" required placeholder="Berapa lama akan menyewa">'
                        +'<b>Lama Sewa / Hari</b>'
                    +'</div>'
                +'</div>'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                        +'<input type="number" name="qty" class="input-material col-sm-12" required placeholder="Berapa banyak yang akan disewa">'
                        +'<b>Jumlah Item Yang Disewa / Hari</b>'
                    +'</div>'
                +'</div>'
                +'<div class="row">'
                    +'<div class="form-group-material col-sm-12">'
                        +'<input type="date" name="date" class="input-material col-sm-12" required placeholder="Berapa banyak yang akan disewa">'
                        +'<b>Kapan sewanya?</b>'
                    +'</div>'
                +'</div>'
            +'</div>'
        +'</form>'
    )
}

function addToCart(type, id) {
    var firstOrder = $('#class').text()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: 'json',
        data: {
            'id' : id,
            'type' : type,
            'total_rental' : $('input[name=total_rental]').val(),
            'qty' : $('input[name=qty]').val(),
            'date' : $('input[name=date]').val(),
            'code' : $('#class span').text()
        },
        url: url + '/order-master/save',
        beforeSend: function(){
            $('#button-order').empty().append('Silakan Tunggu...')
        },
        success: function(res){
            if (res.code === 200) {
                var totalOrder = parseInt(firstOrder) + parseInt(1)
                $('#class').empty().append(totalOrder)
                $('.modal-footer').empty().append('<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>')
                $('.modal-body').empty().append('<p>Sukses menambahkan ke daftar pesanan</p>')
                $('#button-order').empty().append('Tutup')
                $('#button-order').removeClass('btn-success').removeAttr('onclick')
                $('#button-order').addClass('btn-default').attr('data-dismiss', 'modal')
                $(".order-li").empty().append(
                    '<a href="#dropdown" aria-expanded="" data-toggle="collapse">'
                        +'<i class="demo-icon">&#xe8ba;</i>Pesanan Saya &nbsp;'
                        +'<span class="badge bg-red badge-corner">'+ totalOrder +'</span>'
                    +'</a>'
                    +'<ul id="dropdown" class="collapse list-unstyled ">'
                        +'<li class="">'
                            +'<a href="' + url + '/order-future">'
                                +'Pesanan Akan Datang &nbsp;'
                                +'<span class="badge bg-red badge-corner">'+ totalOrder +'</span>'
                            +'</a>'
                        +'</li>'
                        +'<li class=""><a href="' + url + '/order-past">Pesanan Berlalu</a></li>'
                    +'</ul>'
                )

            }else{
                $('#button-order').empty().append('Sewa')
                $('.error-message').css('display', 'block').css('margin-left', '7rem')
                $('.error-message').empty().append(res.message)
            }
        },
        statusCode: {
            500: function(err) {
                $('.modal-body').empty().append(
                    '<p>'+ err.responseJSON.message +'</p>'
                )
            }
        }
    })
}
