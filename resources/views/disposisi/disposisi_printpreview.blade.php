@extends('layouts.app')

@section('css')
<style>
    page {
    background: white;
    display: block;
    margin: 0 auto;
    margin-bottom: 0.5cm;
    box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }

    page[size="A4"] {  
    width: 21cm;
    height: 29.7cm; 
    }

    .pdf-container {
        position: relative;
    }

    .header-wrapper {
        text-align: center;
        margin: 30px 0 45px 0;
        font-weight: bold;
        font-size: 16px;
    }

    .header-disposisi {
        text-align: center;
        margin: 30px 0 45px 0;
        font-weight: bold;
    }

    .kepada-yth {
        font-weight: bold;
        text-decoration: underline;
    }
</style>
@endsection

@section('title')
<title>Detail Aduan Disposisi Nomor Aduan {{$disposisi->id_aduan}} (Konsumen : {{$disposisi->name}})</title>
@endsection

@section('content')
<page class="A4">
<section class="invoice">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pdf-container">
                    <div class="header-wrapper">
                        FORMULIR TINDAK LANJUT
                        <br>
                        UNIT LAYANAN PENGADUAN KONSUMEN (ULPK)
                    </div>
                    <div class="box-body">
                        <div class="kepada-yth">
                            Kepada Yth. <br>
                            Kepala BBPOM Kota Pontianak
                        </div>
                        <br>
                        <div class="dl-horizontal">
                            <dt>
                                Nama Konsumen :
                            </dt>
                            <dd>
                                {{ $disposisi->name }}
                            </dd>
                            <dt>
                                Alamat :
                            </dt>
                            <dd>
                                {{ $disposisi->alamat }}
                            </dd>
                            <dt>
                                Telepon / HP :
                            </dt>
                            <dd>
                                {{ $disposisi->no_hp }}
                            </dd>
                            <dt>
                                Tanggal / Jam Pengaduan :
                            </dt>
                            <dd>
                                {{ $disposisi_aduan_created_at->created_at }}
                            </dd>
                            <dt>
                                Pengaduan / Keterangan :
                            </dt>
                            <dd>
                                {{ $disposisi->isi }}
                            </dd>
                        </div>

                        <br>
                        <br>

                        <div>
                            <b>Petugas ULPK,</b>
                            <br>
                            <br>
                            <b>{{ $petugas->name }}</b>
                        </div>

                        <div class="header-disposisi">
                            <p>MOHON DISPOSISI TINDAK LANJUT</p>
                        </div>
    
                        <div class="dl-horizontal">
                            <dt>
                                Tanggal :
                            </dt>
                            <dd>
                                {{ $disposisi->created_at }}
                            </dd>
                            <dt>
                                Ditujukan Kepada :
                            </dt>
                            <dd>
                                1. {{ $disposisi->bidang }}
                            </dd>
                            <dd>
                                2. Bidang Informasi dan Komunikasi
                            </dd>
                            <dt>
                                Untuk Melakukan :
                            </dt>
                            <dd>
                                {{ $disposisi->note_disposisi }}
                            </dd>
                        </div>

                        <br>
                        <br>

                        <div>
                            <b>Kepala,</b>
                            <br>
                            <br>
                            <b>{{ $kepala->name }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row no-print">
            <div class="col-xs-12">
                <a href="{{ URL::to('/disposisi/'.$disposisi->id.'/print')}}" target="_blank" class="btn btn-default">
                    <i class="fa fa-print"></i> Print
                </a>
                <a href="{{ URL::to('/disposisi/'.$disposisi->id.'/download')}}" class="btn btn-primary" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Download PDF
                </a>
            </div>
        </div>
    </div>
</section>
</page>
@endsection