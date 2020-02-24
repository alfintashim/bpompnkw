@extends('layouts.app')

@section('title')
<title>Tambah Data User</title>
@endsection

@section('breadcumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="page-header">
        Management User
        <small>Tambah User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="{{URL::to('/user')}}"><i class="fa fa-list-alt"></i> User</a></li>
        <li class="active"><i class="fa fa-plus"></i> Tambah User</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ URL::to('/user/add') }}">
                    {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
    
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" placeholder="Enter ...">
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
        
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="id_role">
                            @foreach ($role as $item)
                                <option value="{{$item->id}}">{{$item->rolename}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="form-group">

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-default">Batal</button>
                    <button type="submit" class="btn btn-info pull-right">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection