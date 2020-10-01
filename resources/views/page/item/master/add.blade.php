@extends('template.main')
@section('css')
<link rel="stylesheet" href="{{url('css/plugin/blobselect.css')}}">
@endsection
@section('content')
<div class="col-lg-12">
    <div class="align-items-center">
        <h3 class="h4">{{$title}}</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal">
                <p class="error-message"></p>
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Nama Barang :</label>
                            <input type="text" name="item_name" class="input-material col-sm-8" required placeholder="contoh: Tenda 3x4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Harga Barang / Hari :</label>
                            <input type="number" name="item_price" class="input-material col-sm-8" required placeholder="contoh: 40.000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Deskripsi Barang :</label>
                            <textarea name="item_description" id="desc" rows="3" class="input-material col-sm-8" placeholder="contoh: untuk ukuran 2 - 3 orang" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Stok Barang :</label>
                            <input type="number" name="item_stock" class="input-material col-sm-8" required placeholder="eg: 20">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="col-sm-2 form-control-label">Kategori Barang :</label>
                        <select
                        class="col-sm-8"
                        id="select"
                        name="category_id"
                        data-blobselect-search="true"
                        data-blobselect-order-type="string"
                        data-blobselect-order="asc"
                        data-blobselect-watch="1"
                        >
                            <option value="">---- Silakan Pilih ----</option>
                        </select>
                    </div>
                </form>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Gambar Barang :</label>
                        <input type="file" name="admin_photo" class="input-material col-sm-6" onclick="uploadFile" id="photo" required>
                        <button type="button" onclick="uploadFile()" class="btn btn-primary btn-sm col-sm-2" style="margin-top:2%">Unggah</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group-material row center">
                <div class="col-sm-4 offset-sm-3">
                    <button type="button" onclick="save()" class="btn btn-primary btn-sm">Simpan</button>
                    <button type="reset" onclick="clearForm()" class="btn btn-warning btn-sm">Ulangi</button>
                    <button type="button" onclick="window.history.back()" class="btn btn-danger btn-sm">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- page -->
<script src="{{url('js/page/general/admin/admin.js')}}" charset="utf-8"></script>
<script src="{{url('js/plugin/select.js')}}" charset="utf-8"></script>

<!-- plugin -->
<script src="{{url('js/plugin/blobselect.min.js')}}" charset="utf-8"></script>

<script type="text/javascript">
    this.selectRole()
</script>
@endsection
