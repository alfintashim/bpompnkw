@extends('layouts.app')

@section('title')
<title>Aduan Masyarakat</title>
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
        <li class="active"><i class="fa fa-list-alt"></i> Aduan</li>
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
<!--                 <div class="box-body">
                    <h4>
                    <dl>
                        <dt>Trending untuk minggu ini</dt>
                        <dd>
                             $trending->jenis_produk }}
                        </dd>
                        <dt>Nama produk</dt>
                        <dd>
                             $trending->nama_produk }}
                        </dd>
                    </dl>
                    </h4>
                </div> -->

                <div class="box-body">
                    <div class="col-md-10">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                Daftar Pengaduan Prioritas
                            </h4>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="20">No.</th>
                                    <th width="120">Tanggal Aduan</th>
                                    <th>Nama Produk</th>
                                    <th>Aduan</th>
                                    <th width="120">Konsumen</th>
                                    <th width="30">Status</th>
                                    <th width="1">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tabel_trending as $item)
                                <tr>
                                    <td align="center">{{ $notrending++ }}</td>
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
                                        <span class="label bg-blue">{{ $item->status }}</span>
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
                                    <td align="center">
                                        <div class="btn-group">
                                            <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box">                
                <div class="box-body">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab">
                                    Diterima
                                    <span class="label bg-blue">{{ $jml_diterima }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab_2" data-toggle="tab">
                                    Proses
                                    <span class="label bg-yellow">{{ $jml_diproses }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab_3" data-toggle="tab">
                                    Disposisi
                                    <span class="label bg-orange">{{ $jml_disposisi }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab_4" data-toggle="tab">
                                    Tindak Lanjut
                                    <span class="label bg-teal">{{ $jml_tindaklanjut }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab_5" data-toggle="tab">
                                    Selesai
                                    <span class="label label-success">{{ $jml_selesai }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab_6" data-toggle="tab">
                                    Ditolak
                                    <span class="label label-danger">{{ $jml_ditolak }}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tanggal Aduan</th>
                                            <th>Nama Produk</th>
                                            <th>Aduan</th>
                                            <th>Konsumen</th>
                                            <th>Status</th>
                                            <th width="60">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($aduan_diterima as $item)
                                        @if($item->notif == '1' )
                                        <tr style="font-weight:bold">
                                            <td align="center">{{ $noditerima++ }}</td>
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
                                                <span class="label bg-blue">{{ $item->status }}</span>
                                                @elseif($item->status == 'DIPROSES')
                                                <span class="label bg-yellow">{{ $item->status }}</span>
                                                @elseif($item->status == 'DISPOSISI')
                                                <span class="label bg-orange">{{ $item->status }}</span>
                                                @elseif($item->status == 'TINDAK LANJUT')
                                                <span class="label bg-teal">{{ $item->status }}</span>
                                                @elseif($item->status == 'SELESAI')
                                                <span class="label label-success">{{ $item->status }}</span>
                                                @elseif($item->status == 'DITOLAK')
                                                <span class="label label-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @elseif($item->notif == '0' )
                                        <tr>
                                            <td align="center">{{ $noditerima++ }}</td>
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
                                                <span class="label bg-blue">{{ $item->status }}</span>
                                                @elseif($item->status == 'DIPROSES')
                                                <span class="label bg-yellow">{{ $item->status }}</span>
                                                @elseif($item->status == 'DISPOSISI')
                                                <span class="label bg-orange">{{ $item->status }}</span>
                                                @elseif($item->status == 'TINDAK LANJUT')
                                                <span class="label bg-teal">{{ $item->status }}</span>
                                                @elseif($item->status == 'SELESAI')
                                                <span class="label label-success">{{ $item->status }}</span>
                                                @elseif($item->status == 'DITOLAK')
                                                <span class="label label-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_2">
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tanggal Aduan</th>
                                            <th>Nama Produk</th>
                                            <th>Aduan</th>
                                            <th>Konsumen</th>
                                            <th>Status</th>
                                            <th width="80">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($aduan_diproses as $item)
                                        <tr>
                                            <td align="center">{{ $nodiproses++ }}</td>
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
                                                <span class="label bg-blue">{{ $item->status }}</span>
                                                @elseif($item->status == 'DIPROSES')
                                                <span class="label bg-yellow">{{ $item->status }}</span>
                                                @elseif($item->status == 'DISPOSISI')
                                                <span class="label bg-orange">{{ $item->status }}</span>
                                                 @elseif($item->status == 'TINDAK LANJUT')
                                                <span class="label bg-teal">{{ $item->status }}</span>
                                                @elseif($item->status == 'SELESAI')
                                                <span class="label label-success">{{ $item->status }}</span>
                                                @elseif($item->status == 'DITOLAK')
                                                <span class="label label-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_3">
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tanggal Aduan</th>
                                            <th>Nama Produk</th>
                                            <th>Aduan</th>
                                            <th>Konsumen</th>
                                            <th>Status</th>
                                            <th width="80">#</th>
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
                                                <span class="label bg-blue">{{ $item->status }}</span>
                                                @elseif($item->status == 'DIPROSES')
                                                <span class="label bg-yellow">{{ $item->status }}</span>
                                                @elseif($item->status == 'DISPOSISI')
                                                <span class="label bg-orange">{{ $item->status }}</span>
                                                 @elseif($item->status == 'TINDAK LANJUT')
                                                <span class="label bg-teal">{{ $item->status }}</span>
                                                @elseif($item->status == 'SELESAI')
                                                <span class="label label-success">{{ $item->status }}</span>
                                                @elseif($item->status == 'DITOLAK')
                                                <span class="label label-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_4">
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tanggal Aduan</th>
                                            <th>Nama Produk</th>
                                            <th>Aduan</th>
                                            <th>Konsumen</th>
                                            <th>Status</th>
                                            <th width="80">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($aduan_tindaklanjut as $item)
                                        <tr>
                                            <td align="center">{{ $notindaklanjut++ }}</td>
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
                                                <span class="label bg-blue">{{ $item->status }}</span>
                                                @elseif($item->status == 'DIPROSES')
                                                <span class="label bg-yellow">{{ $item->status }}</span>
                                                @elseif($item->status == 'DISPOSISI')
                                                <span class="label bg-orange">{{ $item->status }}</span>
                                                 @elseif($item->status == 'TINDAK LANJUT')
                                                <span class="label bg-teal">{{ $item->status }}</span>
                                                @elseif($item->status == 'SELESAI')
                                                <span class="label label-success">{{ $item->status }}</span>
                                                @elseif($item->status == 'DITOLAK')
                                                <span class="label label-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.tab-pane -->
                            
                            <div class="tab-pane" id="tab_5">
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tanggal Aduan</th>
                                            <th>Nama Produk</th>
                                            <th>Aduan</th>
                                            <th>Konsumen</th>
                                            <th>Status</th>
                                            <th width="80">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($aduan_selesai as $item)
                                        <tr>
                                            <td align="center">{{ $noselesai++ }}</td>
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
                                                <span class="label bg-blue">{{ $item->status }}</span>
                                                @elseif($item->status == 'DIPROSES')
                                                <span class="label bg-yellow">{{ $item->status }}</span>
                                                @elseif($item->status == 'DISPOSISI')
                                                <span class="label bg-orange">{{ $item->status }}</span>
                                                 @elseif($item->status == 'TINDAK LANJUT')
                                                <span class="label bg-teal">{{ $item->status }}</span>
                                                @elseif($item->status == 'SELESAI')
                                                <span class="label label-success">{{ $item->status }}</span>
                                                @elseif($item->status == 'DITOLAK')
                                                <span class="label label-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_6">
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tanggal Aduan</th>
                                            <th>Nama Produk</th>
                                            <th>Aduan</th>
                                            <th>Konsumen</th>
                                            <th>Status</th>
                                            <th width="80">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($aduan_ditolak as $item)
                                        <tr>
                                            <td align="center">{{ $noditolak++ }}</td>
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
                                                <span class="label bg-blue">{{ $item->status }}</span>
                                                @elseif($item->status == 'DIPROSES')
                                                <span class="label bg-yellow">{{ $item->status }}</span>
                                                @elseif($item->status == 'DISPOSISI')
                                                <span class="label bg-orange">{{ $item->status }}</span>
                                                 @elseif($item->status == 'TINDAK LANJUT')
                                                <span class="label bg-teal">{{ $item->status }}</span>
                                                @elseif($item->status == 'SELESAI')
                                                <span class="label label-success">{{ $item->status }}</span>
                                                @elseif($item->status == 'DITOLAK')
                                                <span class="label label-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ URL::to('/aduan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                                    <!--<a href="{{ URL::to('/aduan/'.$item->id) }}">-->
                                                    <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <!--</a>-->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
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