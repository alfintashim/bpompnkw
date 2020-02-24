@extends('layouts.app')

@section('title')
<title>Laporan Bidang Aduan #{{ $detail_laporan->id_aduan }}</title>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-5">
            <div class="box">
                <div class="box-body">
                    <h4>
                        Laporan Bidang Aduan #{{ $detail_laporan->id_aduan }}
                    </h4>
                </div>
                <div class="box-body">
                    <div class="dl-horizontal">
                        <dt>
                            Nama Dokumen :
                        </dt>
                        <dd>
                            {{ $detail_laporan->filename }}
                            <br>
                            <a href="{{ URL::to('/laporan/'.$detail_laporan->id.'/read') }}" class="btn btn-primary" style="margin-right: 5px;">
                                <i class="fa fa-eye"></i>
                                Buka File
                            </a>
                        </dd>
                        <dt>
                            Keterangan :
                        </dt>
                        <dd>
                            {{ $detail_laporan->keterangan }}
                        </dd>
                        <dt>
                            Uploader :
                        </dt>
                        <dd>
                            {{ $detail_laporan->name }}
                        </dd>
                        <dt>
                            Tanggal Upload :
                        </dt>
                        <dd>
                            {{ $detail_laporan->created_at }}
                        </dd>
                        <dt>
                            Status :
                        </dt>
                        <dd>
                            <span class="label bg-teal">{{ $detail_laporan->status }}</span>
                        </dd>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn bg-navy margin" data-toggle="modal" data-target="#modal-teruskanketerangan">
                        <i class="fa fa-mail-forward"></i> Teruskan Jawaban Keterangan 
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- TERUSKAN KETERANGAN -->
<div class="modal fade" id="modal-teruskanketerangan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Meneruskan Keterangan Laporan Kepada Konsumen</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form role="form">
                        <div class="form-group">
                            <label>Nama Konsumen</label>
                            <input value="{{ $detail_laporan->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input value="{{ $detail_aduan->alamat }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Telepon / HP</label>
                            <input value="{{ $detail_aduan->no_hp }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal / Jam Pengaduan</label>
                            <input value="{{ $detail_aduan->created_at }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Pengaduan / Keterangan</label>
                            <br>
                            {{ $detail_aduan->isi }}
                        </div>
                    </form>
                </div>

                <div class="box-body">
                    <h4>
                        KONFIRMASI JAWABAN KE KONSUMEN
                    </h4>

                    <form role="form" method="POST" action="{{ URL::to('/laporan/'.$detail_laporan->id.'/teruskan_keterangan') }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Status</label>
                            <input value="SELESAI" name="status" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Keterangan di Laporan</label>
                            <textarea class="form-control" disabled="disabled">{{ $detail_laporan->keterangan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Jawaban</label>
                            <textarea class="form-control" name="jawaban">{{ $detail_laporan->keterangan }}</textarea>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-send"></i> Kirim</button>
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