@extends('layouts.app')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $jml_user }}</h3>

          <p>Jumlah User</p>
        </div>
        @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 3)
        <a href="{{ URL::to('/user') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @else
        <a href="#" class="small-box-footer"></a>
        @endif
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3>{{ $jml_aduan_diterima }}</h3>

          <p>Jumlah Pengaduan Saat ini</p>
        </div>
        @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 3)
        <a href="{{ URL::to('/aduan') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @else
        <a href="{{ URL::to('/aduans') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @endif
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $jml_aduan_diproses }}</h3>

          <p>Pengaduan yang Dalam Proses</p>
        </div>
        @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 3)
        <a href="{{ URL::to('/aduan') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @else
        <a href="{{ URL::to('/aduans') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @endif
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $jml_aduan_selesai }}</h3>

          <p>Pengaduan yang Telah Selesai</p>
        </div>
        @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 3)
        <a href="{{ URL::to('/aduan') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @else
        <a href="{{ URL::to('/aduans') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @endif
      </div>
    </div>
    <!-- ./col -->
  </div>

@if(auth()->user()->id_role == 3)
    <div class="row">
        <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="{{ URL::to('/aduan') }}">Pengaduan Baru <span class="pull-right badge bg-blue">{{ $jml_notif_aduan_masuk }}</span></a></li>
                <li><a href="{{ URL::to('/disposisi_infokom') }}">Disposisi Baru <span class="pull-right badge bg-orange">{{ $jml_notif_aduan_disposisi }}</span></a></li>
                <li><a href="{{ URL::to('/laporan') }}">Laporan dari Bidang <span class="pull-right badge bg-teal">{{ $jml_notif_aduan_tindaklanjut }}</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
    </div>
@endif
</section>
@endsection