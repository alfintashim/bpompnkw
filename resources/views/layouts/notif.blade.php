<li class="dropdown notifications-menu">
@if(auth()->user()->id_role == 1 || auth()->user()->id_role == 3)
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-bell-o"></i>
  <span class="label label-danger">{{ notif_total() }}</span>
</a>
<ul class="dropdown-menu">
  <li class="header">Kamu memiliki {{ notif_total() }} pemberitahuan</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
      <li>
        <a href="{{ URL::to('/aduan') }}">
          <i class="fa fa-users text-aqua"></i> {{ notif_baru(1) }} Pengaduan Baru
        </a>
      </li>
      <li>
        <a href="{{ URL::to('/disposisi_infokom') }}">
          <i class="fa fa-reorder text-yellow"></i> {{ notif_baru_disposisi(3) }} Disposisi Baru
        </a>
      </li>
      <li>
        <a href="{{ URL::to('/laporan') }}">
          <i class="fa fa-inbox text-teal"></i> {{ notif_baru(4) }} Laporan Tindak Lanjut Baru
        </a>
      </li>
    </ul>
  </li>
  <li class="footer">
      <!--<a href="#">-->
      <!--    View all-->
      <!--</a>-->
  </li>
</ul>
@elseif(auth()->user()->id_role == 2)
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-bell-o"></i>
  <span class="label label-danger">{{ notif_tindaklanjut() }}</span>
</a>
<ul class="dropdown-menu">
  <li class="header">Kamu memiliki {{ notif_tindaklanjut() }} pemberitahuan</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
      <li>
        <a href="{{ URL::to('/tindak_lanjut') }}">
          <i class="fa fa-inbox text-teal"></i> {{ notif_tindaklanjut() }} Tindak Lanjut Baru
        </a>
      </li>
    </ul>
  </li>
  <li class="footer">
      <!--<a href="#">-->
      <!--    View all-->
      <!--</a>-->
  </li>
</ul>
@endif
</li>