@extends('layouts.app')

@section('title')
<title>Disposisi Aduan</title>
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
        <li class="active"><i class="fa fa-list-alt"></i> Disposisi</li>
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
                    <h4>
                        Daftar Pengaduan Disposisi 
                    </h4>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20">No.</th>
                            <th>Tanggal Aduan</th>
                            <th>Nama Produk</th>
                            <th>Aduan</th>
                            <th>Konsumen</th>
                            <th>Status</th>
                            <th>Bidang</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($aduan_disposisi as $item)
                            <tr>
                                <td align="center">{{ $nodisposisi++ }}</td>
                                <td>
                                    {{ date('j M Y', strtotime($item->created_at)) }}
                                </td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>
                                    {!! str_limit($item->isi, 50, '...') !!}
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if($item->status == 'DITERIMA')
                                    <span class="label bg-red">{{ $item->status }}</span>
                                    @elseif($item->status == 'DIPROSES')
                                    <span class="label bg-yellow">{{ $item->status }}</span>
                                    @elseif($item->status == 'DISPOSISI')
                                    <span class="label bg-orange">{{ $item->status }}</span>
                                    @elseif($item->status == 'SELESAI')
                                    <span class="label label-success">{{ $item->status }}</span>
                                    @elseif($item->status == 'DITOLAK')
                                    <span class="label label-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->bidang }}</td>
                                <td align="center">
                                <div class="btn-group">
                                    <a href="{{ URL::to('/disposisi/'.$item->id) }}">
                                        <i class="fa fa-info-circle"></i>
                                        Detail
                                    </a>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection