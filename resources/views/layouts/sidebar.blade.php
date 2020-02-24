  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('images/user.jpg')}}" width="160px" height="160px" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="@if(url('/') == request()->url() ) active @else '' @endif">
          <a href="{{ URL::to('/')}}">
            <i class="fa fa-home"></i> <span>Beranda</span>
          </a>
        </li>
        
        @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 3)
        <li class="@if(url('/aduan') == request()->url() or url('/trending') == request()->url() ) active treeview @else '' @endif treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Aduan Masyarakat</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/aduan') == request()->url() ) active @else '' @endif">
              <a href="{{ URL::to('/aduan')}}">
                <i class="fa fa-circle-o"></i> Semua Aduan
              </a>
            </li>
            <li class="@if(url('/trending') == request()->url() ) active @else '' @endif">           
              <a href="{{ URL::to('/trending')}}">
                <i class="fa fa-circle-o"></i> Trending Aduan
              </a>
            </li>
          </ul>
        </li>

        <li class="@if(url('/disposisi') == request()->url() or url('/disposisi_infokom') == request()->url() or url('/laporan') == request()->url() ) active treeview @else '' @endif treeview">
          <a href="#">
            <i class="fa fa-reorder"></i>
            <span>Disposisi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/disposisi') == request()->url() ) active @else '' @endif">           
              <a href="{{ URL::to('/disposisi')}}">
                <i class="fa fa-circle-o"></i> Semua Disposisi
              </a>
            </li>
            <li class="@if(url('/disposisi_infokom') == request()->url() ) active @else '' @endif">           
              <a href="{{ URL::to('/disposisi_infokom')}}">
                <i class="fa fa-circle-o"></i> Disposisi
              </a>
            </li>
            <li class="@if(url('/laporan') == request()->url() ) active @else '' @endif">           
              <a href="{{ URL::to('/laporan')}}">
                <i class="fa fa-circle-o"></i> Hasil Laporan Tindak Lanjut
              </a>
            </li>
          </ul>
        </li>
        
        <li class="@if(url('/berita') == request()->url() ) active treeview @else '' @endif treeview">
          <a href="#">
            <i class="fa fa-newspaper-o"></i>
            <span>Berita</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/berita') == request()->url() ) active @else '' @endif">                
              <a href="{{ URL::to('/berita')}}"><i class="fa fa-circle-o"></i> Semua Berita</a>
            </li>
          </ul>
        </li>
         
        <li class="@if(url('/user') == request()->url() ) active treeview @else '' @endif treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/user') == request()->url() ) active @else '' @endif">
              <a href="{{ URL::to('/user')}}"><i class="fa fa-circle-o"></i> User</a>
            </li>
          </ul>  
        </li>
        @endif

<!--KEPALA-->
    @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 2)
        <li class="@if(url('/aduans') == request()->url() ) active treeview @else '' @endif treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Aduan Masyarakat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/aduans') == request()->url() or url('/aduans/{id}') == request()->url()) active @else '' @endif">
              <a href="{{ URL::to('/aduans')}}"><i class="fa fa-circle-o"></i> Semua Aduan</a>
            </li>
          </ul>
        </li>

        <li class="@if(url('/tindak_lanjut') == request()->url() or url('/laporan_bidang') == request()->url() ) active treeview @else '' @endif treeview">
              <a href="#">
                <i class="fa fa-inbox"></i> 
                <span>Tindak Lanjut</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="@if(url('/tindak_lanjut') == request()->url() ) active @else '' @endif">
                  <a href="{{ URL::to('/tindak_lanjut')}}">
                    <i class="fa fa-circle-o"></i> Disposisi Tindak Lanjut
                  </a>
                </li>
                <li class="@if(url('/laporans') == request()->url() ) active @else '' @endif">
                  <a href="{{ URL::to('/laporans')}}">
                    <i class="fa fa-circle-o"></i> Laporan Bidang
                  </a>
                </li>
              </ul> 
        </li>
        @endif
        
<!--BIDANG PENGUJIAN-->
        <li class="@if(url('/disposisi_pengujian') == request()->url() ) active treeview @else '' @endif treeview">
          @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 6)
          <a href="#">
            <i class="fa fa-reorder"></i>
            <span>Disposisi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/disposisi_pengujian') == request()->url() ) active @else '' @endif">
              <a href="{{ URL::to('/disposisi_pengujian')}}"><i class="fa fa-circle-o"></i> Disposisi Aduan</a>
            </li>
          </ul>
          @endif
        </li>
        
<!--BIDANG PEMERIKSAAN-->
        <li class="@if(url('/disposisi_pemeriksaan') == request()->url() ) active treeview @else '' @endif treeview">
          @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 7)
          <a href="#">
            <i class="fa fa-reorder"></i>
            <span>Disposisi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/disposisi_pemeriksaan') == request()->url() ) active @else '' @endif">
              <a href="{{ URL::to('/disposisi_pemeriksaan')}}"><i class="fa fa-circle-o"></i> Disposisi Aduan</a>
            </li>
          </ul>
          @endif
        </li>
        
<!--BIDANG PENINDAKAN-->
        <li class="@if(url('/disposisi_penindakan') == request()->url() ) active treeview @else '' @endif treeview">
          @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 8)
          <a href="#">
            <i class="fa fa-reorder"></i>
            <span>Disposisi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/disposisi_penindakan') == request()->url() ) active @else '' @endif">
              <a href="{{ URL::to('/disposisi_penindakan')}}"><i class="fa fa-circle-o"></i> Disposisi Aduan</a>
            </li>
          </ul>
          @endif
        </li>
        
<!--BAGIAN TATA USAHA-->
        <li class="@if(url('/disposisi_tatausaha') == request()->url() ) active treeview @else '' @endif treeview">
          @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 9)
          <a href="#">
            <i class="fa fa-reorder"></i>
            <span>Disposisi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(url('/disposisi_tatausaha') == request()->url() ) active @else '' @endif">
              <a href="{{ URL::to('/disposisi_tatausaha')}}"><i class="fa fa-circle-o"></i> Disposisi Aduan</a>
            </li>
          </ul>
          @endif
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>