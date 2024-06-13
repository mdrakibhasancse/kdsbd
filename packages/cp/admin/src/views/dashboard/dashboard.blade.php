@extends('admin::layouts.adminMaster')
@section('title')
    | Admin Dashboard | Media
@endsection

@push('css')
@endpush

@section('content')
    <!-- Main content -->
    <section class="content pt-3">
      <div class="row">
        @foreach ($branches as $branch)
        <div class="col-md-4 col-12">
            <div class="card card-widget widget-user-2 shadow-lg">
              <div class="widget-user-header bg-info">
                <a href="{{route('admin.branchArea', $branch)}}">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="{{asset("/img/branch.webp")}}" alt="">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username pt-3 font-weight-bold">{{$branch->name_en}}</h3>
                </a>
              </div>
             
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="{{ route('admin.typeOfOrder',['branch_id'=> $branch->id,'status'=>'pending'])}}" class="nav-link w3-large">
                      Pending Orders <span class="float-right badge bg-danger">{{$branch->orders()->where('order_status','pending')->count()}}</span>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ route('admin.typeOfOrder',['branch_id'=> $branch->id,'status'=>'confirmed'])}}" class="nav-link w3-large">
                      Confirmed Orders<span class="float-right badge bg-primary">{{$branch->orders()->where('order_status','confirmed')->count()}}</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.typeOfOrder',['branch_id'=> $branch->id,'status'=>'delivered'])}}" class="nav-link w3-large">
                      Delivered Orders <span class="float-right badge bg-success">{{$branch->orders()->where('order_status','delivered')->count()}}</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('admin.branchArea',['branch'=> $branch])}}" class="nav-link w3-large">
                      Branch Area
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('admin.pos',['branch'=> $branch])}}" class="nav-link w3-large">
                      Qucick Pos 
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        @endforeach
      </div>


      <div class="mb-2">
        <div class="row">
          <div class="col-md-4">
          <a href="{{route('admin.branchesAll')}}" class="btn w3-deep-orange w3-hover-indigo mr-1 my-1 py-2 rounded btn-sm btn-block {{ str_contains(url()->current(), 'brancharea') ? 'active' : '' }}">
              <i class="fas fa-code-branch"></i> Branch Dashboard
          </a>
          </div>

          <div class="col-md-4">
          <a href="{{route('admin.productsAll')}}" class="btn w3-deep-orange w3-hover-indigo mr-1 my-1 py-2 rounded btn-sm btn-block {{ str_contains(url()->current(), 'product/manage') ? 'active' : '' }}">
          <i class="fas fa-list"></i> Products</a>
          </div>
        </div>
        
      </div>
    </section>
    <!-- /.content -->

@endsection

@push('js')
    <script>

    </script>
@endpush
