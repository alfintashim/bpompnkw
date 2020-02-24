@extends('layouts.app')

@section('title')
<title>Management User</title>
@endsection

@section('breadcumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="page-header">
        Management User
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active"><i class="fa fa-list-alt"></i> User</li>
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
            <a href="{{ URL::to('user/add') }}">
                <button type="button" class="btn btn-success btn-flat pull-right">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </a>
        </div>
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Mobile App</a></li>
            <li><a href="#tab_2" data-toggle="tab">BPOM</a></li>
            <li><a href="#tab_3" data-toggle="tab">Super Admin</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20">No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th width="1">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td align="center">{{ $nouser++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td align="center"><span class="badge bg-light-blue">{{ $item->rolename }}</span></td>
                                <td align="center">
                                <div class="btn-group">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list-ul"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{ URL::to('/user/'.$item->username) }}">
                                                <i class="fa fa-info-circle"></i>
                                                Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('/user/'.$item->username.'/edit') }}">
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
                <!-- /.box-body -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20">No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th width="1">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bpom as $item)
                            <tr>
                                <td>{{ $nobpom++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td align="center"><span class="badge bg-light-blue">{{ $item->rolename }}</span></td>
                                <td align="center">
                                <div class="btn-group">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list-ul"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{ URL::to('/user/'.$item->username.'/edit') }}">
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
                <!-- /.box-body -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20">No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th width="1">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($admin as $item)
                            <tr>
                                <td align="center">{{ $noadmin++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td align="center"><span class="badge bg-light-blue">{{ $item->rolename }}</span></td>
                                <td align="center">
                                <div class="btn-group">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list-ul"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{ URL::to('/user/'.$item->username.'/edit') }}">
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
                <!-- /.box-body -->
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
        </div>
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- END CUSTOM TABS -->
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