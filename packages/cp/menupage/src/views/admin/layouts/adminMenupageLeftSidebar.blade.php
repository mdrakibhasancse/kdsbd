 <li class="nav-item  {{ session('lsbm') == 'menupage' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Menus & Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.menusAll') }}" class="nav-link {{ session('lsbsm') == 'menusAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menus All</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pagesAll')}}" class="nav-link {{ session('lsbsm') == 'pagesAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pages All</p>
                </a>
              </li>
               
            </ul>
          </li>