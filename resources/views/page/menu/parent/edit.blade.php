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
                <input type="hidden" id="url" value="{{url('')}}">
                <input type="hidden" id="queue" value="{{$data['menu_parent_id']}}">
                <p class="error-message"></p>
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Parent Name :</label>
                            <input type="text" name="menu_parent_name" class="input-material col-sm-8" value="{{$data['menu_parent_name']}}" required placeholder="eg: Manage Product">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="col-sm-2 form-control-label">Icon :</label>
                        <select
                        class="demo-icon col-sm-8"
                        id="result-icon"
                        name="menu_icon_id"
                        data-blobselect-search="true"
                        data-blobselect-order-type="string"
                        data-blobselect-order="asc"
                        data-blobselect-watch="1"
                        >
                            <option value="" class="demo-icon">---- Please Select ----</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group-material row center">
                    <div class="col-sm-4 offset-sm-3">
                        <button type="button" onclick="update()" class="btn btn-primary btn-sm">Save</button>
                        <button type="button" onclick="window.history.back()" class="btn btn-danger btn-sm">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- page -->
<script src="{{url('js/page/minify/menu/parent.js')}}" charset="utf-8"></script>
<script src="{{url('js/plugin/select.js')}}" charset="utf-8"></script>

<!-- plugin -->
<script src="{{url('js/plugin/blobselect.min.js')}}" charset="utf-8"></script>

<script type="text/javascript">
    this.selectIcon({{$data['menu_icon_id']}})
</script>
@endsection
