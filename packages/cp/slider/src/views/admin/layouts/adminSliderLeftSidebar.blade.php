 <li class="nav-item  {{ session('lsbm') == 'slider' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-chart-pie"></i>
      <p>
       Sliders
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.slidersAll')}}" class="nav-link {{ session('lsbsm') == 'slidersAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Sliders All</p>
        </a>
      </li>
      
        
    </ul>
</li>