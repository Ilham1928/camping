@extends('template.main')

@section('css')
<link rel="stylesheet" href="{{url('css/plugin/radio.css')}}">
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
                <input type="hidden" id="queue" value="{{$data['cms_config_id']}}">
                <p class="error-message"></p>
                <div class="center">
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">CMS Config Brand :</label>
                            <input type="text" name="cms_config_brand" class="input-material col-sm-8" value="{{$data['cms_config_brand']}}" required placeholder="eg: Product List">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">CMS Color Skin :</label>
                            <label class="container">Default
                                @php $checkedDefault = ($data['cms_config_skin'] == 'default') ? 'checked' : ''; @endphp
                                <input type="radio" {{ $checkedDefault }} value="default" name="cms_config_skin" checked>
                                <span class="checkmark default"></span>
                            </label>
                            <label class="container">Blue
                                @php $checkedBlue = ($data['cms_config_skin'] == 'blue') ? 'checked' : ''; @endphp
                                <input type="radio" {{ $checkedBlue }} value="blue" name="cms_config_skin">
                                <span class="checkmark blue"></span>
                            </label>
                            <label class="container">Green
                                @php $checkedGreen = ($data['cms_config_skin'] == 'green') ? 'checked' : ''; @endphp
                                <input type="radio" {{ $checkedGreen }} value="green" name="cms_config_skin">
                                <span class="checkmark green"></span>
                            </label>
                            <label class="container">Pink
                                @php $checkedPink = ($data['cms_config_skin'] == 'pink') ? 'checked' : ''; @endphp
                                <input type="radio" {{ $checkedPink }} value="pink" name="cms_config_skin">
                                <span class="checkmark pink"></span>
                            </label>
                            <label class="container">Red
                                @php $checkedRed = ($data['cms_config_skin'] == 'red') ? 'checked' : ''; @endphp
                                <input type="radio" {{ $checkedRed }} value="red" name="cms_config_skin">
                                <span class="checkmark red"></span>
                            </label>
                            <label class="container">Sea
                                @php $checkedSea = ($data['cms_config_skin'] == 'sea') ? 'checked' : ''; @endphp
                                <input type="radio" {{ $checkedSea }} value="sea" name="cms_config_skin">
                                <span class="checkmark sea"></span>
                            </label>
                            <label class="container">Violet
                                @php $checkedViolet = ($data['cms_config_skin'] == 'violet') ? 'checked' : ''; @endphp
                                <input type="radio" {{ $checkedViolet }} value="violet" name="cms_config_skin">
                                <span class="checkmark violet"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group-material row center">
                    <div class="col-sm-4 offset-sm-3">
                        <button type="button" onclick="update()" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/menu/config.js')}}" charset="utf-8"></script>
@endsection
