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
                        <i class="fa fa-gear"></i>Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="card-header d-flex align-items-center">
            <h3 class="h4">{{$title}} - {{ $data['role_name'] }}</h3>
        </div>
        <div class="card-body">
            <p class="error-message"></p>
            <input type="hidden" name="queue" value="{{ $data['role_id'] }}">
            <div class="table-responsive" id="tableData">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu Name</th>
                            <th>Menu View</th>
                            <th>Menu Add</th>
                            <th>Menu Edit</th>
                            <th>Menu Delete</th>
                            <th>Menu Other</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu Name</th>
                            <th>Menu View</th>
                            <th>Menu Add</th>
                            <th>Menu Edit</th>
                            <th>Menu Delete</th>
                            <th>Menu Other</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="form-group-material row center">
                <div class="col-sm-12 offset-sm-5">
                    <button type="button" onclick="window.history.back()" class="btn btn-secondary btn-sm">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/admin/permission.js')}}" charset="utf-8"></script>
<script type="text/javascript">
    this.getData({{ $data['role_id'] }});
</script>
@endsection
