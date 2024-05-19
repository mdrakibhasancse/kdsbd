 <li class="nav-item {{ session('lsbm') == 'users' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
        Users
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.usersAll') }}" class="nav-link {{ session('lsbsm') == 'usersAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Users All</p>
        </a>
      </li>               
    </ul>
  </li>


   <li class="nav-item {{ session('lsbm') == 'rolepermission' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Roles & Permissions
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.rolesAll') }}" class="nav-link  {{ session('lsbsm') == 'rolesAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Roles All</p>
        </a>
      </li> 

      <li class="nav-item">
        <a href="{{ route('admin.permissionsAll') }}" class="nav-link  {{ session('lsbsm') == 'permissionsAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Permissions All</p>
        </a>
      </li> 

      <li class="nav-item">
      <a href="{{ route('admin.assignRole') }}" class="nav-link  {{ session('lsbsm') == 'assignRole' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Asign Role</p>
      </a>
    </li> 

    </ul>
  </li>