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
                        <label class="col-sm-2 form-control-label">Nama Barang :</label>
                        <label class="col-sm-8">{{ $data['item_name'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Harga Barang / Hari :</label>
                        <label class="col-sm-8">{{ $data['item_price'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Deskripsi Barang :</label>
                        <label class="col-sm-8">{{ $data['item_description'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Stok Barang :</label>
                        <label class="col-sm-8">{{ $data['item_stock'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Kategori Barang :</label>
                        <label class="col-sm-8">{{ $data['category']['category_name'] ?? '-' }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Gambar Barang :</label>
                        <label class="col-sm-8">
                            <img width="300" src="{{ url('storage/item/' . $data['item_image'] ) }}" alt="photo">
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group-material row center">
                <div class="col-sm-4 offset-sm-3">
                    <button type="button" onclick="window.history.back()" class="btn btn-primary btn-sm">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/item/item-master.js')}}" charset="utf-8"></script>
@endsection
