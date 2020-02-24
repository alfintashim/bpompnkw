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
                            <a href="{{ URL::to('/laporan_bidang/'.$detail_laporan->id.'/read') }}" class="btn btn-primary" style="margin-right: 5px;">
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
                            @if($detail_laporan->status == 'DITERIMA')
                            <span class="label bg-red">{{ $detail_laporan->status }}</span>
                            @elseif($detail_laporan->status == 'DIPROSES')
                            <span class="label bg-yellow">{{ $detail_laporan->status }}</span>
                            @elseif($detail_laporan->status == 'DISPOSISI')
                            <span class="label bg-orange">{{ $detail_laporan->status }}</span>
                            @elseif($detail_laporan->status == 'TINDAK LANJUT')
                            <span class="label bg-teal">{{ $detail_laporan->status }}</span>
                            @elseif($detail_laporan->status == 'SELESAI')
                            <span class="label label-success">{{ $detail_laporan->status }}</span>
                            @elseif($detail_laporan->status == 'DITOLAK')
                            <span class="label label-danger">{{ $detail_laporan->status }}</span>
                            @endif
                        </dd>
                    </div>
                </div>
                <div class="box-footer">

                </div>
            </div>
        </div>
    </div>
</section>
@endsection