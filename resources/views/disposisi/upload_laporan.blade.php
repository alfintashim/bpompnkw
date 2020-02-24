@extends('layouts.app')

@section('title')
<title>Detail Aduan Disposisi | Upload Laporan Bidang</title>
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">

                <div class="box-header with-border">
                    <a type="button" href="{{ URL::to('/disposisi/'.$disposisi->id)}}" class="btn btn-default">Kembali</a>
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

                <div class="box-body">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-upload">
                        <i class="fa fa-plus"></i> Upload Dokumen
                    </button>
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
                    <h4>
                    <div class="dl-horizontal">
                        <dt>
                            Nama Dokumen :
                        </dt>
                        <dd>
                            {{ $laporan->filename }}
                        </dd>
                        <dt>
                            Keterangan :
                        </dt>
                        <dd>
                            {{ $laporan->keterangan }}
                        </dd>
                        <dt>
                            Uploader :
                        </dt>
                        <dd>
                            {{ $laporan->name }}
                        </dd>
                    </div>
                    </h4>
                </div>

            </div>
        </div>
    </div>

<!-- UPLOAD DOKUMEN -->
    <div class="modal fade" id="modal-upload">
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
                                <textarea class="form-control" name="keterangan"></textarea>
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