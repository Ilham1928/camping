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
                        <label class="col-sm-8">{{ $price = ($data['is_cancel'] == 0) ? 'Belum Bayar' : 'Sudah Bayar' }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Status Pesanan :</label>
                        <label class="col-sm-8">{{ $isCancel = ($data['total_price'] == 0) ? 'Diproses' : 'Dibatalkan' }}</label>
                    </div>
                </div>
                @if($data['total_price'] != 0)
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Total Yang dibayar :</label>
                            <label class="col-sm-8">{{ $data['total_price'] }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Catatan :</label>
                            <label class="col-sm-8">{{ $data['order_note'] }}</label>
                        </div>
                    </div>
                @endif
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
                <hr>
                <strong>Detail Pesanan</strong>
                <br>
                <br>
                <div class="table-responsive" id="tableData">
                    <center>
                        <p class="error-message"></p>
                    </center>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Lama Sewa</th>
                                <th>Total Sewa</th>
                                <th>Harga Sewa</th>
                                @if($data['total_price'] == 0)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = collect($data['order_detail'])->map(function($item){
                                    $data['total_price'] = $item['item_price'] * $item['order_qty'] * $item['total_rental'];
                                    return $data;
                                })->sum('total_price');
                            @endphp
                            @foreach($data['order_detail'] as $value => $detail)
                                <tr id="data-"{{ $detail['order_detail_id'] }}>
                                    <td>{{ $value+1 }}</td>
                                    @if($data['order_type'] == 'Barang')
                                        <td>{{ $detail['item_name'] }}</td>
                                    @else
                                        <td>{{ $detail['guide_name'] }}</td>
                                    @endif
                                    <td>
                                        <span class="span-rental-{{ $detail['order_detail_id'] }}">{{ $detail['total_rental'] }} Hari</span>
                                        <input type="number" class="input-material col-sm-8 input-rental-{{ $detail['order_detail_id'] }}" style="display:none">
                                    </td>
                                    <td>
                                        <span class="span-qty-{{ $detail['order_detail_id'] }}">{{ $detail['order_qty'] }}</span>
                                        <input type="number" class="input-material col-sm-8 input-qty-{{ $detail['order_detail_id'] }}" style="display:none">
                                    </td>
                                    @if($data['order_type'] == 'Barang')
                                        <td>Rp.{{ number_format($detail['item_price']) }} / Hari</td>
                                    @else
                                        <td>Rp.{{ number_format($detail['guide_price']) }} / Hari</td>
                                    @endif
                                    @if($data['total_price'] == 0)
                                        <td id="button-{{ $detail['order_detail_id'] }}">
                                            <button type="button" name="button" class="btn btn-success btn-sm" onclick="update({{$detail['order_detail_id']}}, '{{$data['order_type']}}')">Ubah</button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total Pembayaran</strong></td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td><strong style="color:red">Rp.{{ number_format($total) }}</strong></td>
                                @if($data['total_price'] == 0)
                                    <td>-</td>
                                @endif
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Lama Sewa</th>
                                <th>Total Sewa</th>
                                <th>Harga Sewa</th>
                                @if($data['total_price'] == 0)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <hr>
            <div class="form-group-material row center">
                <div class="col-sm-6 offset-sm-6">
                    <button type="button" onclick="window.location.replace('{{ url('/order-master') }}')" class="btn btn-primary btn-sm">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/order/order-detail.js')}}" charset="utf-8"></script>
@endsection
