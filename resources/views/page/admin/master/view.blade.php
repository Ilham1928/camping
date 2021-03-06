@extends('template.main')
@section('content')
<div class="container-fluid">
    <button type="button" name="button" class="btn btn-primary btn-sm" onclick="location.href='{{url('admin-master/add')}}'">Add New</button>
    <button type="button" name="button" class="btn btn-danger btn-sm" id="bulkDelete" style="display:none" onclick="bulkDelete()">Bulk Delete</button>
</div>
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
            <h3 class="h4">{{$title}}</h3>
        </div>
        <div class="card-body">
            <p class="error-message">asdasd</p>
            <div class="table-responsive" id="tableData">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" onclick="selectAll()" id="checkbox-parent" class="checkbox-template"></th>
                            <th>#</th>
                            <th>Admin Name</th>
                            <th>Admin Title</th>
                            <th>Admin Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Admin Name</th>
                            <th>Admin Title</th>
                            <th>Admin Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="link"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/admin/admin.js')}}" charset="utf-8"></script>
<script type="text/javascript">
    this.getData();
</script>
@endsection
