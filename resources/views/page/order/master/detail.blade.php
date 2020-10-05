@extends('template.main')
@section('content')
<div class="col-lg-12">
    <div class="align-items-center">
        <h3 class="h4">{{$title}}</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="center">
                <strong>Data Pesanan</strong>
                <hr>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Kode Pesanan :</label>
                        <label class="col-sm-8">{{ $data['order_code'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Tipe Pesanan :</label>
                        <label class="col-sm-8">{{ $data['order_type'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Tanggal Pesanan :</label>
                        <label class="col-sm-8">{{ $data['order_date'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Status Pembayaran :</label>
                        <label class="col-sm-8">{{ $price = ($data['total_price'] == 0) ? 'Belum Bayar' : 'Sudah Bayar' }}</label>
                    </div>
                </div>
                <strong>Data Pemesan</strong>
                <hr>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Nama Pemesan :</label>
                        <label class="col-sm-8">{{ $data['fullname'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">No Identitas KTP :</label>
                        <label class="col-sm-8">{{ $data['id_card'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Email Pemesan :</label>
                        <label class="col-sm-8">{{ $data['email'] }}</label>
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
<script src="{{url('js/page/general/order/order.js')}}" charset="utf-8"></script>
@endsection
