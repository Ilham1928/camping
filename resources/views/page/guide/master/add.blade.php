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
                            <label class="col-sm-2 form-control-label">Nama Pemandu :</label>
                            <input type="text" name="guide_name" class="input-material col-sm-8" required placeholder="contoh: Daniel">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Harga Pemandu / Hari :</label>
                            <input type="number" name="guide_price" class="input-material col-sm-8" required placeholder="contoh: 100.000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Pengalaman Pemandu (Dalam Tahun) :</label>
                            <input type="number" name="guide_experience" class="input-material col-sm-8" required placeholder="contoh: 4">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="col-sm-2 form-control-label">Jenis Kelamin Pemandu :</label>
                        <select class="col-sm-8"
                            id="select"
                            name="guide_gender"
                            data-blobselect-search="true"
                            data-blobselect-order-type="string"
                            data-blobselect-order="asc"
                            data-blobselect-watch="1">
                            <option value="">---- Silakan Pilih ----</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Ulang Tahun Pemandu :</label>
                            <input type="date" name="guide_birthday" class="input-material col-sm-8" required>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Foto Pemandu :</label>
                        <input type="file" name="item_image" class="input-material col-sm-6" id="photo" required>
                        <button type="button" onclick="uploadFile()" class="btn btn-primary btn-sm col-sm-2" style="margin-top:2%">Unggah</button>
                    </div>
                </div>
                <span id="preview">
                    <img id="img-preview" style="max-width:100%; display:none" alt="photo">
                </span>
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
<script src="{{url('js/plugin/blobselect.min.js')}}" charset="utf-8"></script>
<script src="{{url('js/page/general/guide/guide.js')}}" charset="utf-8"></script>
@endsection
