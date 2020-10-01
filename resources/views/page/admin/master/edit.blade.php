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
                <p class="error-message"></p>
                <input type="hidden" name="queue" value="{{ $data['admin_id'] }}">
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Admin Name :</label>
                            <input type="text" name="admin_name" class="input-material col-sm-8" value="{{ $data['admin_name'] }}" required placeholder="eg: Dony Lark">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Admin Title :</label>
                            <input type="text" name="admin_title" class="input-material col-sm-8" value="{{ $data['admin_title'] }}" required placeholder="eg: ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Admin Description :</label>
                            <textarea name="admin_description" id="desc" rows="3" class="input-material col-sm-8" placeholder="Describe task admin" required>{{ $data['admin_description'] }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Admin Email :</label>
                            <input type="text" name="admin_email" class="input-material col-sm-8" value="{{ $data['admin_email'] }}" required placeholder="eg: font-awesome">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="col-sm-2 form-control-label">Role :</label>
                        <select
                            class="col-sm-8"
                            id="select"
                            name="role_id"
                            data-blobselect-search="true"
                            data-blobselect-order-type="string"
                            data-blobselect-order="asc"
                            data-blobselect-watch="1"
                        >
                            <option value="">---- Please Select ----</option>
                        </select>
                    </div>
                </form>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Admin Photo :</label>
                        <input type="file" name="admin_photo" class="input-material col-sm-6" onclick="uploadFile(true)" id="photo" required>
                        <button type="button" onclick="uploadFile(true)" class="btn btn-primary btn-sm col-sm-2" style="margin-top:2%">Upload</button>
                    </div>
                    <span id="preview">
                        <img id="img-preview" style="max-width:100%" src="{{ asset('images/users').'/'.$data['admin_photo'] }}" alt="photo">
                    </span>
                </div>
            </div>
            <hr>
            <div class="form-group-material row center">
                <div class="col-sm-4 offset-sm-3">
                    <button type="button" onclick="update()" class="btn btn-primary btn-sm">Save</button>
                    <button type="button" onclick="window.history.back()" class="btn btn-danger btn-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- page -->
<script src="{{url('js/page/general/admin/admin.js')}}" charset="utf-8"></script>
<script src="{{url('js/plugin/select.js')}}" charset="utf-8"></script>

<!-- plugin -->
<script src="{{url('js/plugin/blobselect.min.js')}}" charset="utf-8"></script>

<script type="text/javascript">
    this.selectRole({{ $data['role_id'] }})
</script>
@endsection
