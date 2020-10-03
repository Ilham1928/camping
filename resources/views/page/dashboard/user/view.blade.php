@extends('template.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/dashboard/dashboard-style.css') }}">
@endsection
@section('content')
 <div class="container">
    <h3>Peralatan Camping</h3>
	<div class="row">
        @if(!empty($data['item']))
            @foreach($data['item'] as $item)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="my-list">
        			<img style="padding:10px"     src="{{ asset('storage/item/' . $item['item_image']) }}" />
        			<h3>Nama Alat : {{ $item['item_name'] }}</h3>
        			<span>{{ $item['category']['category_name'] }}</span>
        			<div class="offer">{{ substr($item['item_description'], 0, 50) }}..</div>
        			<div class="detail">
    		            <p>{{ $item['item_name'] }}</p>
                        <img style="padding:10px" src="{{ asset('storage/item/' . $item['item_image']) }}" />
                        <a href="#" class="btn btn-info">Pesan</a>
                        <button data-toggle="modal" data-target="#myModal" class="btn btn-info">Deatil Barang</button>
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
    <br><br><hr><br>
    <h3>Pemandu</h3>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            @if(!empty($data['guide']))
                @foreach($data['guide'] as $guide)
                    <div class="my-list">
                        <img style="padding:10px" src="{{ asset('storage/guide/' . $guide['guide_photo']) }}" />
            			<h3>{{ $guide['guide_name'] }}</h3>
            			<span>{{ $guide['guide_gender'] }}</span>
            			<div class="offer">Pengalaman : {{ $guide['guide_experience'] }} Tahun</div>
            			<div class="detail">
        		            <p>{{ $guide['guide_name'] }}</p>
                            <img style="padding:10px" src="{{ asset('storage/guide/' . $guide['guide_photo']) }}" />
                            <a href="#" class="btn btn-info">Pesan Pemandu</a>
                            <a href="#" class="btn btn-info">Deatil Pemandu</a>
            			</div>
            		</div>
                @endforeach
            @else
                <p>Tidak Ada Pemandu</p>
            @endif
		</div>
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
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
