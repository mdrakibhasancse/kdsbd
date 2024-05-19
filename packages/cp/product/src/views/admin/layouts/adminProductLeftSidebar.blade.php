  <li class="nav-item  {{ session('lsbm') == 'product' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas  fa-shopping-cart"></i>
      <p>
        Products
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.productCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'productCategoriesAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Categories All</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.productSubCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'productSubCategoriesAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>SubCategories All</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.branchesAll')}}" class="nav-link {{ session('lsbsm') == 'branchesAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Branches All</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.productsAll')}}" class="nav-link {{ session('lsbsm') == 'productsAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Products All</p>
        </a>
      </li>
        
    </ul>
  </li>

  <li class="nav-item  {{ session('lsbm') == 'order' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas  fa-folder"></i>
      <p>
        Orders
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.orderList')}}" class="nav-link {{ session('lsbsm') == 'orderList' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Order List</p>
        </a>
      </li>
     
    </ul>
  </li>