<a href="{{route('admin.branchArea', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'brancharea') ? 'active' : '' }}">
    <i class="fas fa-plus-square"></i> Area Manage
</a>

<a href="{{ route('admin.branchWiseProductManage', $branch)}}" class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'product/manage') ? 'active' : '' }}">
<i class="fas fa-plus-square"></i> Product Manage</a>

<a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'order/manage') ? 'active' : '' }}" href="{{ route('admin.branchWiseOrderManage', $branch)}}"><i class="fas fa-cart-plus"></i> Order Manage</a>

<a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm {{ str_contains(url()->current(), 'branch/edit') ? 'active' : '' }}" href="{{route('admin.branchEdit', $branch)}}"><i class="fas fa-edit"></i>
    Edit Branch</a>


<a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm" href="{{ route('admin.dealsAll', $branch)}}"><i class="fas fa-plus-square"></i> Deals</a>

<a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm" href="{{ route('admin.pos', $branch)}}"><i class="fas fa-plus-square"></i> Pos Management</a>

<a class="btn btn-outline-primary mr-1 my-1 rounded btn-sm" href="{{ route('admin.branchOrderReport', $branch)}}"><i class="fas fa-plus-square"></i> Order Report</a>
