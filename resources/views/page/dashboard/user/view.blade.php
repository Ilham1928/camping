@extends('template.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/dashboard/dashboard-style.css') }}">
@endsection
@section('content')
 <div class="container">
    <h3>Peralatan Camping</h3>
	<div class="row">
        @if(!$data['item']->isEmpty())
            @foreach($data['item'] as $item)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="my-list">
        			<img style="padding:10px"     src="{{ asset('storage/item/' . $item['item_image']) }}" />
        			<h3>Nama Alat : {{ $item['item_name'] }}</h3>
        			<span>Kategori : {{ $item['category']['category_name'] }}</span>
        			<div class="offer">Deskripsi : {{ substr($item['item_description'], 0, 50) }}..</div>
        			<div class="detail">
    		            <p>{{ $item['item_name'] }}</p>
                        <img style="padding:10px" src="{{ asset('storage/item/' . $item['item_image']) }}" />
                        <button type="button" onclick="getForm('item', {{ $item['item_id'] }}, '{{ $item['item_name'] }}')" class="btn btn-info">Pesan</button>
                        <button onclick="detail('item', {{ $item['item_id'] }})" class="btn btn-info">Detail Barang</button>
        			</div>
        		</div>
            </div>
            @endforeach
        @else
            <p>Tidak Ada Peralatan</p>
        @endif
	</div>
    <br>
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        {{ $data['item']->links() }}
    </div>
    <span id="class" style="display:none">0</span>
    <br><br><hr><br>
    <h3>Pemandu</h3>
	<div class="row">
        @if(!$data['guide']->isEmpty())
            @foreach($data['guide'] as $guide)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="my-list">
                        <img style="padding:10px" src="{{ asset('storage/guide/' . $guide['guide_photo']) }}" />
            			<h3>Nama : {{ $guide['guide_name'] }}</h3>
            			<span>Jenis Kelamin : {{ $guide['guide_gender'] }}</span>
            			<div class="offer">Pengalaman : {{ $guide['guide_experience'] }} Tahun</div>
            			<div class="detail">
        		            <p>{{ $guide['guide_name'] }}</p>
                            <img style="padding:10px" src="{{ asset('storage/guide/' . $guide['guide_photo']) }}" />
                            <button type="button" onclick="getForm('guide', {{ $guide['guide_id'] }}, '{{ $guide['guide_name'] }}')" class="btn btn-info">Pesan Pemandu</button>
                            <button type="button" onclick="detail('guide', {{ $guide['guide_id'] }})" class="btn btn-info">Detail Pemandu</button>
            			</div>
            		</div>
                </div>
            @endforeach
        @else
            <p>Tidak Ada Pemandu</p>
        @endif
	</div>
    <br>
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        {{ $data['guide']->links() }}
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{url('js/page/general/dashboard/user.js')}}" charset="utf-8"></script>
@endsection
