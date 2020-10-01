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
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Role Name :</label>
                            <input type="text" name="role_name" class="input-material col-sm-8" required placeholder="eg: Business Development">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Role Description :</label>
                            <textarea name="role_description" id="desc" rows="3" class="input-material col-sm-8" placeholder="eg: Manage All Content" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="form-group-material row center">
                <div class="col-sm-4 offset-sm-3">
                    <button type="button" onclick="save()" class="btn btn-primary btn-sm">Save</button>
                    <button type="reset" onclick="clearForm()" class="btn btn-warning btn-sm">Reset</button>
                    <button type="button" onclick="window.history.back()" class="btn btn-danger btn-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- page -->
<script src="{{url('js/page/general/admin/role.js')}}" charset="utf-8"></script>
@endsection
