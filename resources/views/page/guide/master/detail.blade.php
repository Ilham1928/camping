@extends('template.main')
@section('content')
<div class="col-lg-12">
    <div class="align-items-center">
        <h3 class="h4">{{$title}}</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="center">
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Nama Pemandu :</label>
                        <label class="col-sm-8">{{ $data['guide_name'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Pengalaman :</label>
                        <label class="col-sm-8">{{ $data['guide_experience'] }} Tahun</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Harga Pemandu / Hari :</label>
                        <label class="col-sm-8">{{ number_format($data['guide_price']) }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Ulang Tahun :</label>
                        <label class="col-sm-8">{{ $data['guide_birthday'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Jenis Kelamin :</label>
                        <label class="col-sm-8">{{ $data['guide_gender'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Foto Pemandu :</label>
                        <label class="col-sm-8">
                            <img width="300" src="{{ url('storage/guide/' . $data['guide_photo'] ) }}" alt="photo">
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group-material row center">
                <div class="col-sm-4 offset-sm-3">
                    <button type="button" onclick="window.history.back()" class="btn btn-primary btn-sm">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/guide/guide.js')}}" charset="utf-8"></script>
@endsection
