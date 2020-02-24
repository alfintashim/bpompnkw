@extends('layouts.app')

@section('title')
<title>Laporan Hasil Tindak Lanjut</title>
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
                        Daftar Laporan Hasil Tindak Lanjut
                    </h4>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Tanggal Upload</th>
                            <th>Nama Dokumen</th>
                            <th>Keterangan</th>
                            <th>Bidang</th>
                            <th>Uploader</th>
                            <th>Status</th>
                            <th>No. Aduan</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($laporan as $item)
                            <tr>
                                <td>
                                    {{ date('j M Y', strtotime($item->created_at)) }}
                                </td>
                                <td>{{ $item->filename }}</td>
                                <td>
                                    {!! str_limit($item->keterangan, 50, '...') !!}
                                </td>
                                <td>{{ $item->bidang }}</td>
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
                                <td>{{ $item->id_aduan }}</td>
                                <td align="center">
                                <div class="btn-group">
                                    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                                    <!--    <i class="fa fa-list-ul"></i>-->
                                    <!--</a>-->
                                    <!--<ul class="dropdown-menu dropdown-menu-right">-->
                                    <!--    <li>-->
                                    <!--        <a href="{{ URL::to('/laporans/'.$item->id) }}">-->
                                    <!--            <i class="fa fa-info-circle"></i>-->
                                    <!--            Detail-->
                                    <!--        </a>-->
                                    <!--    </li>-->
                                    <!--    <li>-->
                                    <!--        <a href="{{ URL::to('/laporans/'.$item->id.'/read') }}">-->
                                    <!--            <i class="fa fa-eye"></i>-->
                                    <!--            Buka File-->
                                    <!--        </a>-->
                                    <!--    </li>-->
                                    <!--</ul>-->
                                    <a href="{{ URL::to('/laporans/'.$item->id.'/read') }}">
                                        <i class="fa fa-eye"></i>
                                        Buka File
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