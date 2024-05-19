 <li class="nav-item  {{ session('lsbm') == 'websitesetting' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-desktop"></i>
      <p>
       Website Setup
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.websitesetting')}}" class="nav-link {{ session('lsbsm') == 'websitesettings' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Website Setup</p>
        </a>
      </li>
      
        
    </ul>
</li>

