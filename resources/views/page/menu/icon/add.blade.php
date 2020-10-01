@extends('template.main')
@section('content')
<div class="col-lg-12">
    <div class="align-items-center">
        <h3 class="h4">{{$title}}</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal">
                <input type="hidden" id="url" value="{{url('')}}">
                <p class="error-message"></p>
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Name :</label>
                            <input type="text" name="menu_icon_name" class="input-material col-sm-8" required placeholder="eg: plus">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Class :</label>
                            <input type="text" name="menu_icon_class" class="input-material col-sm-8" required placeholder="eg: fa-plus">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Unicode :</label>
                            <input type="text" name="menu_icon_unicode" class="input-material col-sm-8" required placeholder="eg: &copys">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Brand :</label>
                            <input type="text" name="menu_icon_brand" class="input-material col-sm-8" required placeholder="eg: font-awesome">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group-material row center">
                    <div class="col-sm-4 offset-sm-3">
                        <button type="button" onclick="save()" class="btn btn-primary btn-sm">Save</button>
                        <button type="reset" onclick="clearForm()" class="btn btn-warning btn-sm">Reset</button>
                        <button type="button" onclick="window.history.back()" class="btn btn-danger btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/menu/icon.js')}}" charset="utf-8"></script>
@endsection
