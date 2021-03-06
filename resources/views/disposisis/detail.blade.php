@extends('layouts.app')

@section('title')
<title>Detail Aduan Disposisi</title>
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
        <li><a href="{{URL::to('/disposisi')}}"><i class="fa fa-list-alt"></i> Disposisi</a></li>
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
                    <a href="{{ URL::to('/disposisi')}}">
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
                            <span class="label bg-red">{{ $detail_aduan->status }}</span>
                            @elseif($detail_aduan->status == 'DIPROSES')
                            <span class="label bg-yellow">{{ $detail_aduan->status }}</span>
                            @elseif($detail_aduan->status == 'DISPOSISI')
                            <span class="label bg-orange">{{ $detail_aduan->status }}</span>
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
                                Disposisi
                            </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab">
                                Detail Aduan
                                <span class="label bg-teal"></span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Catatan Jawaban</label>

                                        <div class="col-sm-10">
                                            <b>
                                            {{ $disposisi->note_disposisi }}
                                            </b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Bidang</label>
                    
                                        <div class="col-sm-10">
                                            <input value="{{ $disposisi->bidang }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <form class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Isi Aduan</label>

                                        <div class="col-sm-10">
                                            <b>
                                            {{ $detail_aduan->isi }}
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
                                        <a href="{{ URL::to('/aduan/'.$detail_aduan->id.'/gambar') }}" class="btn btn-primary" style="margin-right: 5px;">
                                            <i class="fa fa-eye"></i>
                                            Buka File Gambar
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
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

<!-- TERUSKAN NOTE DISPOSISI -->
<div class="modal fade" id="modal-teruskanjawaban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Meneruskan Catatan Disposisi Kepada Konsumen</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form role="form">
                        <div class="form-group">
                            <label>Nama Konsumen</label>
                            <input value="{{ $detail_aduan->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input value="{{ $detail_aduan->alamat }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Telepon / HP</label>
                            <input value="{{ $detail_aduan->no_hp }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal / Jam Pengaduan</label>
                            <input value="{{ $detail_aduan->created_at }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Pengaduan / Keterangan</label>
                            <br>
                            {{ $detail_aduan->isi }}
                        </div>
                    </form>
                </div>

                <div class="box-body">
                    <h4>
                        KONFIRMASI JAWABAN KE KONSUMEN
                    </h4>

                    <form role="form" method="POST" action="{{ URL::to('/disposisi/'.$disposisi->id.'/teruskan_note_disposisi') }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Status</label>
                            <input value="SELESAI" name="status" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Catatan Disposisi</label>
                            <textarea class="form-control" disabled="disabled">{{ $disposisi->note_disposisi }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Jawaban</label>
                            <textarea class="form-control" name="jawaban">{{ $disposisi->note_disposisi }}</textarea>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-send"></i> Kirim</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- GANTI STATUS -->
<form method="POST" action="{{ URL::to('/disposisi/'.$disposisi->id.'/ganti_status') }}" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="modal fade" id="modal-gantistatus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ganti Status</h4>
                </div>
                <div class="modal-body">
                    <select class="form-control select2" style="width: 100%;" name="status">
                            <option selected="selected">{{ $detail_aduan->status }}</option>
                            <option>DITERIMA</option>
                            <option>DIPROSES</option>
                            <option>DISPOSISI</option>
                            <option>SELESAI</option>              
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-send"></i> Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>

<!-- UPLOAD DOKUMEN -->
<div class="modal fade" id="modal-upload-laporan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload Dokumen</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                <form class="form-horizontal" method="POST" action="{{ URL::to('/disposisi/'.$disposisi->id.'/upload_laporan') }}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                            <input type="file" id="exampleInputFile" name="filename">

                            <p class="help-block">Format .PDF, .DOCX, .DOC, .XLS, .XLSX</p>
                    </div>
                    <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" required></textarea>
                    </div>

                    <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" name="laporan_status" disabled>
                                    <option selected="selected">PENDING</option>            
                            </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-send"></i> Upload</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
@endsection