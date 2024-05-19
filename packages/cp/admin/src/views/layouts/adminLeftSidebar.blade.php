<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('https://i.pinimg.com/originals/40/96/65/4096655428526bf2aa6c11ada5649247.jpg') }}" alt="Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <div class="sidebar">
    
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-legacy" data-widget="treeview" role="menu" data-accordion="true">
    
        <li class="nav-item  {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
          
        </li>

        @includeIf('userrole::admin.layouts.adminUserRoleLeftSidebar')
        {{-- @includeIf('menupage::admin.layouts.adminMenupageLeftSidebar') --}}
        @includeIf('product::admin.layouts.adminProductLeftSidebar')
        @includeIf('media::admin.layouts.adminMediaLeftSidebar')
        @includeIf('slider::admin.layouts.adminSliderLeftSidebar')
        @includeIf('language::admin.layouts.adminLanguageLeftSidebar')
        @includeIf('websitesetting::admin.layouts.adminWebsiteSettingLeftSidebar')

      </ul>
    </nav>
  </div>
</aside>
