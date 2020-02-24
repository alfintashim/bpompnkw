@extends('layouts.app')

@section('title')
<title>Detail User</title>
@endsection

@section('breadcumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="page-header">
        Management User
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="{{URL::to('/user')}}"><i class="fa fa-list-alt"></i> User</a></li>
        <li class="active"><i class="fa fa-info-circle"></i> Detail</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <a href="{{ URL::to('/user')}}">
                        <button type="submit" class="btn btn-default">Kembali</button>
                    </a>
                    <h3 class="box-title">Data Lengkap {{ $biouser->name }}</h3>
                    <div class="pull-right">
                    <form method="POST" action="{{ URL::to('/user/'.$biouser->username.'/nonaktif') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                            Non-Aktifkan
                        </button>
                    </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
        
                        <div class="col-sm-10">
                            <input value="{{ $biouser->name }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Kelamin</label>
        
                        <div class="col-sm-10">
                            <input value="{{ $biouser->jk }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        
                        <div class="col-sm-10">
                            <input value="{{ $biouser->email }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
        
                        <div class="col-sm-10">
                            <textarea style="resize:none" cols="113" rows="5" readonly> {{ $biouser->alamat }} </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Profesi</label>
    
                        <div class="col-sm-10">
                            <input value="{{ $biouser->profesi }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Instansi</label>
    
                        <div class="col-sm-10">
                            <input value="{{ $biouser->instansi }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon</label>
    
                        <div class="col-sm-10">
                            <input value="{{ $biouser->no_hp }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No. KTP</label>
    
                        <div class="col-sm-10">
                            <input value="{{ $biouser->no_ktp }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">KTP</label>
    
                        <div class="col-sm-10">
                            <!--<img src="{{ asset('storage/profil/'.$biouser->ktp) }}">-->
                            <img src="{{ url('storage/profil/'.$biouser->ktp) }}">
                            <!--<img src="{{ url('storage/ktp/'.$biouser->ktp) }}">-->
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection