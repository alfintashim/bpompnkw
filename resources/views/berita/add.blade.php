@extends('layouts.app')

@section('title')
<title>Tambah Data Berita</title>
@endsection

@section('breadcumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="page-header">
        Berita
        <small>Tambah Berita</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="{{URL::to('/berita')}}"><i class="fa fa-list-alt"></i> Berita</a></li>
        <li class="active"><i class="fa fa-plus"></i> Tambah Berita</li>
    </ol>
</section>
@endsection

@section('css')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">    
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Form</h3>
                </div>

                <form class="form-horizontal" method="POST" action="{{ URL::to('/berita/add') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul</label>
        
                        <div class="col-sm-10">
                            <input type="text" name="judul" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Isi</label>
        
                        <div class="col-sm-10">
                            <textarea id="editor1" class="form-control" name="editor1" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="exampleInputFile">Gambar</label>
        
                        <div class="col-sm-10">
                            <input type="file" id="exampleInputFile">

                            <p class="help-block">Format .JPG, .PNG</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Penulis</label>
        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="status">
                                    <option selected="selected">DRAFT</option>
                                    <option>PUBLISH</option>
                                    <option>NON-ACTIVE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" class="btn btn-default">Batal</button>
                    <button type="submit" class="btn btn-info pull-right">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
{{-- <script>
    CKEDITOR.addCss('.cke_editable p { margin: 0 !important; }');
    CKEDITOR.replace('editor1');
</script> --}}

<!-- CK Editor -->
<script type="text/javascript" src="{{ asset('backend/bower_components/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{ asset('backend/bower_components/ckeditor/styles.js')}}"></script>
{{-- <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('ckeditor/styles.js')}}"></script> --}}

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
{{-- <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script> --}}

<script>
    var editor1 = document.getElementById("editor1");
        CKEDITOR.replace(editor1,{
        language:'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
</script>
@endsection