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
            $('.modal-content').css('width', '100%')
            $('.modal-body').empty().append(
                '<p>Silakan Tunggu ...</p>'
            )
        },
        success: function(res){
            if (res.code === 200) {
                $('.modal-body').html("")
                $('.modal-content').css('width', 'fit-content')
                if (type === 'item') {
                    $('.modal-body').empty().append(
                        '<img style="padding:10px" src="' + url + '/storage/item/' + res.data.item_image +'" />'
                        +'<p>'
                            +'<b>Nama Barang</b> : ' + res.data.item_name + '</br>'
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

function ageOld(dob) {
    console.log(dob);
    // var diff_ms = Date.now() - dob.getTime();
    // var age_dt = new Date(diff_ms);
    //
    // return Math.abs(age_dt.getUTCFullYear() - 1970);
}
