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
            <h3 class="h4">{{$title}} | {{ date('F') }}</h3>
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
                    <tbody></tbody>
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
            <div class="link"></div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/order/order.js')}}" charset="utf-8"></script>
<script type="text/javascript">
    this.getData();
</script>
@endsection
