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
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Child Name :</label>
                            <input type="text" name="menu_child_name" class="input-material col-sm-8" required placeholder="eg: Product List">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">Menu Child Url :</label>
                            <input type="text" name="menu_child_url" class="input-material col-sm-8" required placeholder="eg: Product-master">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="col-sm-2 form-control-label">Parent :</label>
                        <select
                        class="col-sm-8"
                        id="select"
                        name="menu_parent_id"
                        data-blobselect-search="true"
                        data-blobselect-order-type="string"
                        data-blobselect-order="asc"
                        data-blobselect-watch="1"
                        >
                            <option value="">---- Please Select ----</option>
                        </select>
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
<!-- page -->
<script src="{{url('js/page/general/menu/child.js')}}" charset="utf-8"></script>
<script src="{{url('js/plugin/select.js')}}" charset="utf-8"></script>

<!-- plugin -->
<script src="{{url('js/plugin/blobselect.min.js')}}" charset="utf-8"></script>

<script type="text/javascript">
    this.selectParent()
</script>
@endsection
