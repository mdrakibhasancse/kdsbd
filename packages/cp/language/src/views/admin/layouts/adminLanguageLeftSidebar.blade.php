<li class="nav-item  {{ session('lsbm') == 'languages' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas  fa-globe"></i>
      <p>
        Languages
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.languages')}}" class="nav-link {{ session('lsbsm') == 'language' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Languages</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.translations')}}" class="nav-link {{ session('lsbsm') == 'translation' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Translations</p>
        </a>
      </li>

    </ul>
  </li>
