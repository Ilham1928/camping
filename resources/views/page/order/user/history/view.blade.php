@extends('template.main')
@section('content')
<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-close">
            <div class="dropdown">
                <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow">
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-print"></i>Print
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-gear"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
        <div class="card-header d-flex align-items-center">
            <h3 class="h4">{{$title}}</h3>
        </div>
        <div class="card-body">
            <p class="error-message"></p>
            <div class="table-responsive" id="tableData">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Pesanan</th>
                            <th>Code Pesanan</th>
                            <th>Total item</th>
                            <th>Tipe Pesanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$data->isEmpty())
                            @foreach($data as $index => $order)
                                @php $disabled = ($order['is_checkout'] == 0) ? '' : 'disabled' @endphp
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $order['order_date'] }}</td>
                                    <td>{{ $order['order_code'] }}</td>
                                    <td>{{ $order['qty'] }}</td>
                                    <td>{{ $order['order_type'] }}</td>
                                    <td>
                                        @if($order['is_checkout'] == 1)
                                            @if($order['total_price'] == 0)
                                                <label class="col-sm-8">{{ 'Menunggu Diproses' }}</label>
                                            @else
                                                <label class="col-sm-8">{{ 'Diproses' }}</label>
                                            @endif
                                        @else
                                            @if($order['is_cancel'] == 1)
                                                <label class="col-sm-8">{{ 'Dibatalkan' }}</label>
                                            @else
                                                <label class="col-sm-8">{{ 'Belum Checkout' }}</label>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" onclick="detail({{$order['order_id']}})" class="btn btn-warning btn-sm">Detail</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td style="text-align:center" colspan="10">No Data Available</td>
                            </tr>
                        @endif
                    </tbody>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Pesanan</th>
                            <th>Code Pesanan</th>
                            <th>Total item</th>
                            <th>Tipe Pesanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="link">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Berhasil Checkout
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="reload()">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/order/user.js')}}" charset="utf-8"></script>
@endsection
