@extends('template.main')
@section('content')
<div class="col-lg-12">
    <div class="align-items-center">
        <h3 class="h4">{{$title}}</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal">
                <p class="error-message"></p>
                <input type="hidden" name="queue" value="{{ $data['category_id'] }}">
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Nama Kategori :</label>
                            <input type="text" name="category_name" class="input-material col-sm-8" value="{{ $data['category_name'] }}" required placeholder="contoh: Alat Masak">
                        </div>
                    </div>
                </form>
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
<script src="{{url('js/page/general/item/item-category.js')}}" charset="utf-8"></script>
@endsection
