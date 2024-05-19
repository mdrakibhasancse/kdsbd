 <li class="nav-item  {{ session('lsbm') == 'media' ? ' menu-open ' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-chart-pie"></i>
    <p>
      Medias
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.mediasAll')}}" class="nav-link {{ session('lsbsm') == 'mediasAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Medias All</p>
      </a>
    </li>
    
      
  </ul>
</li>


