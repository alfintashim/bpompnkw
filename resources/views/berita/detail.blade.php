@extends('layouts.app')

@section('title')
<title>{{ $berita->judul }}</title>
@endsection

@section('breadcumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="page-header">
        Berita
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="{{URL::to('/berita')}}"><i class="fa fa-list-alt"></i> Berita</a></li>
        <li class="active"><i class="fa fa-info-circle"></i> Detail Berita</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <a href="{{ URL::to('/berita')}}">
                        <button type="submit" class="btn btn-default">Kembali</button>
                    </a>
                    <h3 class="box-title">Detail Berita</h3>
                    <br>
                    <br>
                    <h4>
                        Waktu : {{ $berita->created_at }} ( {{ $berita->updated_at }} )
                    </h4>
                    <h4>
                        Status : 
                        @if($berita->status == 'DRAFT')
                        <span class="label bg-yellow">{{ $berita->status }}</span>
                        @elseif($berita->status == 'PUBLISH')
                        <span class="label label-success">PUBLISHED</span>
                        @elseif($berita->status == 'NON-ACTIVE')
                        <span class="label label-danger">{{ $berita->status }}</span>
                        @endif
                    </h4>
                </div>
                <div class="box-header with-border">
                    <div class="pull-left btn-group"> 
                        <form method="POST" action="{{ URL::to('/berita/'.$berita->id.'/nonaktif') }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <a type="button" class="btn bg-navy margin" href="{{ URL::to('berita/'.$berita->id.'/edit') }}">
                                <i class="fa fa-edit"></i> Edit Berita
                            </a>

                            <button type="button" class="btn bg-navy margin" data-toggle="modal" data-target="#modal-gantistatus">
                                <i class="fa fa-check-circle"></i> Ganti Status 
                            </button>
                            
                            <button type="submit" class="btn bg-navy margin">
                                <i class="fa fa-ban"></i> Nonaktifkan Berita 
                            </button>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        
                        <div class="col-sm-10">
                            @if($berita->gambar == NULL) 
                            <img src="{{ asset('uploads/Berita/no-image.jpg') }}"/>
                            @else
                            <img src="{{ asset('uploads/Berita/'.$berita->gambar) }}"/> 
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul</label>
        
                        <div class="col-sm-10">
                            <input class="form-control" value="{{ $berita->judul }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Isi</label>
        
                        <div class="col-sm-10">
                            {!! $berita->isi !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Penulis</label>
        
                        <div class="col-sm-10">
                            <input class="form-control" value="{{ $berita->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" disabled>
                                    <option selected="selected">{{ $berita->status }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                </form>
            </div>
        </div>
    </div>

<!-- GANTI STATUS -->
<form method="POST" action="{{ URL::to('/berita/'.$berita->id.'/ganti_status') }}">
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
                    <select class="form-control select2" style="width: 100%;" name="status" required>
                            <option>DRAFT</option>
                            <option>PUBLISH</option>
                            <option>NON-ACTIVE</option>           
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
</section>
@endsection