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
                <input type="hidden" name="queue" value="{{ $data['guide_id'] }}">
                <p class="error-message"></p>
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Nama Pemandu :</label>
                            <input type="text" name="guide_name" value="{{ $data['guide_name'] }}" class="input-material col-sm-8" required placeholder="contoh: Daniel">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Pengalaman Pemandu (Dalam Tahun) :</label>
                            <input type="number" name="guide_experience" value="{{ $data['guide_experience'] }}" class="input-material col-sm-8" required placeholder="contoh: 4">
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
                            @if($data['guide_gender'] == 'Laki-laki')
                                <option selected value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            @else
                                <option value="Laki-laki">Laki-laki</option>
                                <option selected value="Perempuan">Perempuan</option>
                            @endif
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Ulang Tahun Pemandu :</label>
                            <input type="date" name="guide_birthday" value="{{ $data['guide_birthday'] }}" class="input-material col-sm-8" required>
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
                    <img id="img-preview" style="max-width:100%;" src="{{ url('storage/guide/' . $data['guide_photo']) }}" alt="photo">
                </span>
            </div>
            <hr>
            <div class="form-group-material row center">
                <div class="col-sm-4 offset-sm-3">
                    <button type="button" onclick="update()" class="btn btn-primary btn-sm">Simpan</button>
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
