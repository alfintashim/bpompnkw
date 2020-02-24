@extends('layouts.app')

@section('title')
<title>Detail Aduan Masyarakat</title>
@endsection

@section('breadcumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="page-header">
        Aduan Masyarakat
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="{{URL::to('/aduans')}}"><i class="fa fa-list-alt"></i> Aduan</a></li>
        <li class="active"><i class="fa fa-info-circle"></i> Detail</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">

                <div class="box-header with-border">
                    <a href="{{ URL::to('/aduans')}}">
                        <button type="submit" class="btn btn-default">Kembali</button>
                    </a>
                    <h3 class="box-title">Detail Aduan</h3>
                    <br>
                    <br>
                    <h4>
                        No : {{ $detail_aduan->id }}
                    </h4>
                    <h4>
                    Dari : <b>{{ $detail_aduan->name }}</b> (<b>{{ $detail_aduan->email }}</b>) 
                    <a href="" data-toggle="modal" data-target="#modal-pelapor">
                        <i class="fa fa-info-circle"></i>
                        Detail Pelapor
                    </a>
                    </h4>
                    <h4>
                        Waktu : {{ $detail_aduan->created_at }}
                    </h4>
                    <h4>
                        Status : 
                            @if($detail_aduan->status == 'DITERIMA')
                            <span class="label bg-blue">{{ $detail_aduan->status }}</span>
                            @elseif($detail_aduan->status == 'DIPROSES')
                            <span class="label bg-yellow">{{ $detail_aduan->status }}</span>
                            @elseif($detail_aduan->status == 'DISPOSISI')
                            <span class="label bg-orange">{{ $detail_aduan->status }}</span>
                            @elseif($detail_aduan->status == 'TINDAK LANJUT')
                            <span class="label bg-teal">{{ $detail_aduan->status }}</span>
                            @elseif($detail_aduan->status == 'SELESAI')
                            <span class="label label-success">{{ $detail_aduan->status }}</span>
                            @elseif($detail_aduan->status == 'DITOLAK')
                            <span class="label label-danger">{{ $detail_aduan->status }}</span>
                            @endif
                    </h4>
                    <h4>
                        Petugas : {{ $petugas->name }}
                    </h4>
                </div>

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab">
                                Detail
                            </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab">
                                Balasan
                            </a>
                        </li>
                        <li>
                            <a href="#tab_3" data-toggle="tab">
                                Jawaban
                                <span class="label bg-teal"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_4" data-toggle="tab">
                                Log
                                <span class="label bg-yellow"></span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Isi Aduan</label>

                                        <div class="col-sm-10">
                                            <b>
                                            <textarea class="form-control" disabled="disabled" style="font-size: 16px">{{ $detail_aduan->isi }}</textarea>
                                            </b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Produk</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->jenis_produk }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama Produk</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->nama_produk }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">No Reg</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->no_reg }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tanggal Kadaluarsa</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->tgl_exp }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama Pabrik</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->nama_pabrik }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Alamat Pabrik</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->alamat_pabrik }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nomor Batch</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->no_batch }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Alamat Beli</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->alamat_beli }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Lokasi Beli</label>

                                        <div class="col-sm-10">
                                            {{-- Google Maps --}}
                                            {{-- <div class="container"> --}}
                                                <div id="map_container"></div>
                                                <div id="map-canvas"></div>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tanggal Guna</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->tgl_guna }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Info Tambahan</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $detail_aduan->info_lain }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Gambar</label>
                                        
                                        <div class="col-sm-10">
                                        <a href="{{ URL::to('/aduans/'.$detail_aduan->id.'/gambar') }}" class="btn btn-primary" style="margin-right: 5px;">
                                            <i class="fa fa-eye"></i>
                                            Buka File Gambar
                                        </a>
                                        </div>
                                        <!-- <div class="col-sm-10">
                                            @if($detail_aduan->gambar == NULL) 
                                            <img src="{{ asset('uploads/Aduan/no-image.jpg') }}"/>
                                            @else
                                            <img width="480px" src="{{ asset('uploads/Aduan/'.$detail_aduan->gambar1) }}"/> 
                                            @endif
                                        </div>
 -->                                </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>

                        <div class="tab-pane" id="tab_2">
                            <div class="box direct-chat direct-chat-danger">
                                <div class="box-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                    @foreach($baca_pesan as $item)
                                    @if($item->id_role == '3') 
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">{{ $item->name}}</span>
                                        <span class="direct-chat-timestamp pull-right">{{ $item->created_at }}</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" width="128" height="128" src="{{ asset('images/user.jpg')}}">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                        {{ $item->pesan }}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    @elseif($item->id_role == '4') 
                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">{{ $item->name}}</span>
                                        <span class="direct-chat-timestamp pull-left">{{ $item->created_at }}</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" width="128" height="128" src="{{ asset('uploads/User/user.jpg')}}">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                        {{ $item->pesan }}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                    @endif
                                    @endforeach
                                    </div>
                                    <!--/.direct-chat-messages-->
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_4">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    @foreach($log_aduan as $item)
                                    <ul class="products-list product-list-in-box">
                                    <li class="item">
                                        <div class="product-img">
                                        <img src="{{ asset('backend/dist/img/default-50x50.gif')}}" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                        <div class="product-title">{{ $item->name }}                                                
                                            <small class="text-muted pull-right">
                                                <i class="fa fa-clock-o"></i> {{ $item->created_at }}
                                            </small>
                                        </div>
                                        <span class="product-description">
                                                {{ $item->status }}
                                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                    </ul>
                                    @endforeach
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_3">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Jawaban Aduan</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" disabled="disabled" style="font-size: 16px">{{ $detail_aduan->jawaban }}</textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </div> <!-- /.nav-tabs -->
            </div>
        </div>
    </div>

<!-- DETAIL PELAPOR -->
<div class="modal fade" id="modal-pelapor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama</label>
            
                            <div class="col-sm-10">
                                <input value="{{ $detail_aduan->name }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Kelamin</label>
            
                            <div class="col-sm-10">
                                <input value="{{ $detail_aduan->jk }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            
                            <div class="col-sm-10">
                                <input value="{{ $detail_aduan->email }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
            
                            <div class="col-sm-10">
                                {{ $detail_aduan->alamat }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Profesi</label>
        
                            <div class="col-sm-10">
                                <input value="{{ $detail_aduan->profesi }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Instansi</label>
        
                            <div class="col-sm-10">
                                <input value="{{ $detail_aduan->instansi }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telepon</label>
        
                            <div class="col-sm-10">
                                <input value="{{ $detail_aduan->no_hp }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">No. KTP</label>
        
                            <div class="col-sm-10">
                                <input value="{{ $detail_aduan->no_ktp }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">KTP</label>
        
                            <div class="col-sm-10">
                                <!--<img src="{{ asset('uploads/KTP/'.$detail_aduan->ktp) }}">-->
                                <img src="{{ url('storage/profil/'.$detail_aduan->ktp) }}" width="90%" height="90%">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

</section>
@endsection

@section('script')
<style>
    #map_container{
      position: relative;
    }

    #map-canvas{
        height: 0;
    overflow: hidden;
    padding-bottom: 22.25%;
    padding-top: 300px;
    position: relative;
    }
    
</style>

{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNp149aNlTFsMm6WWcPTaHqHIZPOz-5j4&callback=initMap"
async defer></script> --}}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZPgmW2n82k6914VDzUXkLXj1vsLrwKjs&callback=initMap"
async defer></script>

<script>
    
    function initMap() {
        var map;
        var lat= {{$detail_aduan->lat}};
        var lng= {{$detail_aduan->lng}};
        map = new google.maps.Map(document.getElementById('map-canvas'), {
        center:{
            lat: lat,
            lng: lng
        },
        zoom:16,

        styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
    });

        
        

        var marker = new google.maps.Marker({
        position: {
            lat: lat,
            lng: lng
        },
        map: map,
    });



    google.maps.event.addListener(marker,'position_changed', function() {

        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();

        $('#lat').val(lat);
        $('#lng').val(lng);
    });

    }
    </script>


            <script type="text/javascript">
           function functionDelete(nilai) {
              $('form').attr('action', '{{ url("/aduan/{id}/delete") }}');
              var link = "aduan/{id}/";
              $('#modal_delete').modal('show');
              $.get(link + 'getdata/' + nilai, function (data) {
                console.log(data);
                $('#id_delete').val(data.id);
                $('.aduan').text(data.pesan);

            // $('#modal_delete').modal('show');
          }) 
         }
        </script>
@endsection