@extends('layouts.app')

@section('title')
<title>Hasil Laporan</title>
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
                        Daftar Laporan dari Bidang
                    </h4>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Tanggal Upload</th>
                            <th>Nama Dokumen</th>
                            <th>Keterangan</th>
                            <th>Uploader</th>
                            <th>Status</th>
                            <th>No. Aduan</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($laporan as $item)
                        @if($item->notif == 4 )
                            <tr style="font-weight:bold">
                                <td>
                                    {{ date('j M Y', strtotime($item->created_at)) }}
                                </td>
                                <td>{{ $item->filename }}</td>
                                <td>
                                    {!! str_limit($item->keterangan, 50, '...') !!}
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="label bg-teal">{{ $item->status }}</span>
                                </td>
                                <td>{{ $item->id_aduan }}</td>
                                <td align="center">
                                <div class="btn-group">
                                    <form method="POST" action="{{ URL::to('/laporan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                        </button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @elseif($item->notif == 0 )
                            <tr>
                                <td>
                                    {{ date('j M Y', strtotime($item->created_at)) }}
                                </td>
                                <td>{{ $item->filename }}</td>
                                <td>
                                    {!! str_limit($item->keterangan, 50, '...') !!}
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="label bg-teal">{{ $item->status }}</span>
                                </td>
                                <td>{{ $item->id_aduan }}</td>
                                <td align="center">
                                <div class="btn-group">
                                    <form method="POST" action="{{ URL::to('/laporan/'.$item->id.'/') }}">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-block btn-info btn-xs" type="submit">
                                                        <i class="fa fa-info-circle"></i>
                                                        Detail
                                        </button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @endif
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