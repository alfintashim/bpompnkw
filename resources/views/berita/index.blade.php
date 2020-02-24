@extends('layouts.app')

@section('title')
<title>Berita</title>
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
        <li class="active"><i class="fa fa-newspaper-o"></i> Berita</li>
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
                    <a href="{{ URL::to('berita/add') }}">
                        <button type="button" class="btn btn-success btn-flat pull-right">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
                    </a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20">No.</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($berita as $item)
                            <tr>
                                <td align="center">{{ $noberita++ }}</td>
                                <td align="center">
                                    @if($item->gambar == NULL) 
                                    <img width="40px" class="img-circle" src="{{ asset('uploads/Berita/no-image.jpg') }}"/>
                                    @else
                                    <img width="40px" class="img-circle" src="{{ asset('uploads/Berita/'.$item->gambar) }}"/>   
                                    @endif
                                </td>
                                <td>
                                    {{ $item->judul }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    @if($item->status == 'DRAFT')
                                    <span class="label bg-yellow">{{ $item->status }}</span>
                                    @elseif($item->status == 'PUBLISH')
                                    <span class="label label-success">PUBLISHED</span>
                                    @elseif($item->status == 'NON-ACTIVE')
                                    <span class="label label-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ date('j M Y', strtotime($item->created_at)) }}
                                </td>
                                <td align="center">
                                <div class="btn-group">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list-ul"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{ URL::to('/berita/'.$item->id) }}">
                                                <i class="fa fa-info-circle"></i>
                                                Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('/berita/'.$item->id.'/edit') }}">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                        </li>
                                    </ul>
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