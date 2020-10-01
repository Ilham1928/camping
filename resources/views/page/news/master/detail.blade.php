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
                        <label class="col-sm-2 form-control-label">News Title :</label>
                        <label class="col-sm-8">{{ $data['news_title'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Created At :</label>
                        <label class="col-sm-8">{{ date('d M, Y', strtotime($data['created_at'])) }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">Created By :</label>
                        <label class="col-sm-8">{{ $data['created_by'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">News Content :</label>
                        <label class="col-sm-8">{{ $data['news_content'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group-material col-sm-12">
                        <label class="col-sm-2 form-control-label">News image :</label>
                        @if(!empty($data['news_image']))
                            <label class="col-sm-8">
                                <img width="500" src="{{ asset('storage/news/'. $data['news_image']) }}" alt="photo">
                            </label>
                        @endif
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
