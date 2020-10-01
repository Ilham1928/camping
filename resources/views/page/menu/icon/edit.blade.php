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
                <input type="hidden" id="queue" value="{{$data['menu_icon_id']}}">
                <p class="error-message"></p>
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Name :</label>
                            <input type="text" name="menu_icon_name" value="{{$data['menu_icon_name']}}" class="input-material col-sm-8" required placeholder="eg: plus">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Class :</label>
                            <input type="text" name="menu_icon_class" value="{{$data['menu_icon_class']}}" class="input-material col-sm-8" required placeholder="eg: fa-plus">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Unicode :</label>
                            <input type="text" name="menu_icon_unicode" value="{{$data['menu_icon_unicode']}}" class="input-material col-sm-8" required placeholder="eg: fa-plus">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Icon Brand :</label>
                            <input type="text" name="menu_icon_brand" value="{{$data['menu_icon_brand']}}" class="input-material col-sm-8" required placeholder="eg: font-awesome">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group-material row center">
                    <div class="col-sm-4 offset-sm-3">
                        <button type="button" onclick="update()" class="btn btn-primary btn-sm">Save</button>
                        <button type="button" onclick="window.location.href='{{url('menu/icon')}}'" class="btn btn-danger btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/minify/menu/icon.js')}}" charset="utf-8"></script>
@endsection
