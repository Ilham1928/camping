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
                        <label class="col-sm-2 form-control-label">Admin Name :</label>
                        <label class="col-sm-8">{{ $data['admin_name'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Admin Title :</label>
                        <label class="col-sm-8">{{ $data['admin_title'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Admin Description :</label>
                        <label class="col-sm-8">{{ $data['admin_description'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Admin Email :</label>
                        <label class="col-sm-8">{{ $data['admin_email'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Admin Role :</label>
                        <label class="col-sm-8">{{ $data['role_name'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Admin Photo :</label>
                        <label class="col-sm-8">
                            <img width="300" src="{{ asset('storage/admin/' . $data['admin_photo'] ) }}" alt="photo">
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
<script src="{{url('js/page/general/admin/admin.js')}}" charset="utf-8"></script>
@endsection
