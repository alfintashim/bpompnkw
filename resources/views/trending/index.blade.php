@extends('layouts.app')

@section('title')
<title>Trending Aduan Masyarakat</title>
@endsection

@section('breadcumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="page-header">
        Trending Aduan
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active"><i class="fa fa-list-alt"></i> Trending</li>
    </ol>
</section>
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
	<div class="row">
    	<div class="col-xs-12">
        	<div class="box">
        		<div class="box-body">
        			<button class="btn btn-success btn-flat" type="button" data-toggle="modal" data-target="#tambah-trending">
        				<i class="fa fa-plus"></i> Tambah Data
        			</button>
        		</div>

        		<div class="box-body">
                    <div class="col-md-4">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                Jenis Produk Trending dalam 7 hari
                            </h4>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>
                                        Jenis Produk
                                    </th>
                                    <th>
                                        Jumlah
                                    </th>
                                </tr>
                                @foreach ($trending as $item)
                                <tr>
                                    <td>
                                        {{ $item->jenis_produk }}
                                    </td>
                                    <td>
                                        {{ $item->jumlah }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            Daftar Pengaduan dalam 7 Hari Terakhir
                        </h4>
                    </div>
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20">No.</th>
                            <th>Jenis Produk</th>
                            <th>Nama Produk</th>
                            <th>Isi Aduan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aduan_last_seven_days as $item)
                        <tr>
                            <td align="center">
                                {{ $no++ }}
                            </td>
                            <td>
                                {{ $item->jenis_produk }}
                            </td>
                            <td>
                                {{ $item->nama_produk }}
                            </td>
                            <td>
                                {{ $item->isi }}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>

<!-- TAMBAH DATA TRENDING -->
<form method="POST" action="{{ URL::to('/trending') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade" id="tambah-trending">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Tambah Trending Aduan</h4>
                </div>
                <div class="modal-body">
                	<div class="form-group">
                        <label>Jenis Produk Trending</label>
                        <input type="text" name="jenis_produk" value="{{ $trending_new->jenis_produk }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-send"></i> Kirim</button>
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

@section('script')
<!-- DataTables -->
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
$(function () {
$('#example1').DataTable()
$('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : false,
    'info'        : true,
    'autoWidth'   : false
})
})
</script>
@endsection