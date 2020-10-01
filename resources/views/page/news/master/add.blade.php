@extends('template.main')
@section('css')
    <link rel="stylesheet" href="{{ url('css/page/news/news.css') }}">
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
                            <label class="col-sm-2 form-control-label">News Title :</label>
                            <input type="text" name="news_title" class="input-material col-sm-8" required placeholder="eg: Covid-19 has populate...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <label class="col-sm-2 form-control-label">News Content :</label>
                            <textarea name="news_content" id="content" rows="5" class="input-material col-sm-8" placeholder="Tell more about this news" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group-material col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Upload Image :</label>
                                <div class="input-material col-sm-8">
                                    <div class="preview-zone hidden">
                                        <div class="dropzone-wrapper row">
                                            <div class="preview row">
                                                <!-- image appear here -->
                                            </div>
                                            <div class="dropzone-desc">
                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                <p>Choose an image file or drag it here.</p>
                                            </div>
                                            <input type="file" name="img_logo" class="dropzone" id="photo" onchange="uploadFile()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
</div>
@endsection

@section('js')
<script src="{{url('js/page/general/news/news.js')}}" charset="utf-8"></script>
@endsection
