@extends('frontend::layouts.pageMaster')

@push('css')

@endpush
@section('content')
    
    <div class="container account-container custom-account-container py-5">
        <div class="row">
            
            <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">

            <div class="card">
                <div class="card-body">
                    <h3 class="text-uppercase w-large">My Account</h3>
                    <ul class="nav nav-tabs flex-column mb-0" role="tablist">
                        <li class="nav-item pb-3">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
                                role="tab" aria-controls="dashboard" aria-selected="true" style="text-decoration: none">Dashboard</a>
                        </li>

                        <li class="nav-item pb-3">
                            <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                                aria-controls="order" aria-selected="true" style="text-decoration: none">Orders</a>
                        </li>


                        {{-- <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">Addresses</a>
                        </li> --}}

                        <li class="nav-item pb-3">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                                aria-controls="edit" aria-selected="false" style="text-decoration: none">Personal Info</a>
                        </li>
                        
                        {{-- <li class="nav-item pb-3">
                            <a class="nav-link" href="javascript:void(0)" style="text-decoration: none">Wishlist</a>
                        </li> --}}
                        <li class="nav-item pb-3">
                            <a class="nav-link" href="javascript:void(0)" onclick="$('#logout-form').submit();" style="text-decoration: none">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
                
            </div>


            <div class="col-lg-9 order-lg-last order-1 tab-content">
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                    <div class="dashboard-content">
                    
                        <div class="row">
                           <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-between" style="min-height:101px;">
                                       <div class="left">
                                            <span class="w3-large font-weight-bold">{{ $user->orders()->count()}}</span>
                                            <h5 class="w3-large">Orders</h5>
                                       </div>

                                       <div class="right w3-xxlarge">
                                         <i class="fa fa-shopping-cart w3-text-green"></i>
                                       </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-between" style="min-height:101px;">
                                       <div class="left">
                                            <span class="w3-large font-weight-bold">{{ $todayOrdersCount }}</span>
                                            <h5 class="w3-large">Today Orders</h5>
                                       </div>

                                       <div class="right w3-xxlarge">
                                         <i class="fa fa-shopping-cart w3-text-green"></i>
                                       </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-between" style="min-height:101px;">
                                       <div class="left pb-0 mb-0">
                                            <span class="w3-large font-weight-bold">{{ $cancelOrdersCount }}</span>
                                            <h5 class="w3-large">Cancel Order</h5>
                                       </div>

                                       <div class="right w3-xxlarge pb-0 mb-0">
                                         <i class="fa fa-shopping-cart w3-text-green"></i>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .row -->
                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="order" role="tabpanel">


                    <div class="card">
                        <div class="card-header py-3 w3-green">
                            <h3 class="card-title w3-text-white pt-2">Orders</h3>  
                        </div>
                        <div class="card-body">
                             <div class="order-content">
                      
                                <div class="order-table-container text-center">
                                    <table class="table table-bordered text-left">
                                        <thead>
                                            <tr>
                                                <th class="order-id">ORDER</th>
                                                <th class="order-date">DATE</th>
                                                <th class="order-status">STATUS</th>
                                                <th class="order-price">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
                                                @forelse ($orders as $key => $order)
                                                
                                                <tr>
                                                    <td>{{ $order->id}}</td>
                                                    <td>{{ $order->created_at->format("Y-m-d")}}</td>
                                                    <td>{{$order->order_status}}</td>
                                                    <td>{{$order->total_amount}}</td>
                                                </tr>

                                                @empty
                                                    <tr>
                                                        <td class="text-center p-0" colspan="5">
                                                            <p class="mb-5 mt-5">
                                                                No Order has been made yet.
                                                            </p>
                                                    </td>
                                                    </tr>
                                                @endforelse

                                        </tbody>
                                    </table>
                                   

                                    <a href="{{url('/')}}" class="btn btn-dark">Go Shop</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div><!-- End .tab-pane -->


                <div class="tab-pane fade" id="edit" role="tabpanel">

                    <div class="card">
                        <div class="card-header py-3 w3-green">
                            <h3 class="card-title w3-text-white pt-2"><i
                            class="icon-user-2 pr-1"></i>&nbsp;Account Details</h3>  
                        </div>
                        <div class="card-body">

                            <div class="card-body">
                                <div class="account-content">
                                    <form action="{{ route('user.changeMyInformation')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="acc-name">First name <span class="required">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Name" value="{{$user->name ?? old('name')}}"
                                                         name="name" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="acc-lastname">Mobile <span
                                                    class="required">*</span></label>
                                                    <input type="text" class="form-control" id="mobile"
                                                    name="mobile" value="{{$user->mobile ?? old('mobile')}}"placeholder="Enter mobile number" required />
                                                </div>
                                            </div>
                                        </div>

                                       


                                        <div class="form-group mb-4">
                                            <label for="email">Email address <span class="required">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email ?? old('email')}}"
                                                placeholder="example@gmail.com" required />
                                        </div>

                                        <div class="change-password">
                                            <h3 class="text-uppercase mb-2">Password Change</h3>

                                            <div class="form-group">
                                                <label for="old_password">Current Password</label>
                                                <input type="password" class="form-control" id="old_password"
                                                    name="old_password" />
                                            </div>

                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="password" class="form-control" id="new_password"
                                                    name="new_password" />
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm_password">Confirm New Password</label>
                                                <input type="password" class="form-control" id="confirm_password"
                                                    name="confirm_password" />
                                            </div>
                                        </div>

                                        <div class="form-footer mt-3 mb-0">
                                            <button type="submit" class="btn btn-dark mr-0">
                                                Save changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="billing" role="tabpanel">
                    <div class="address account-content mt-0 pt-2">
                        <h4 class="title">Billing address</h4>

                        <form class="mb-2" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company </label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="select-custom">
                                <label>Country / Region <span class="required">*</span></label>
                                <select name="orderby" class="form-control">
                                    <option value="" selected="selected">British Indian Ocean Territory
                                    </option>
                                    <option value="1">Brunei</option>
                                    <option value="2">Bulgaria</option>
                                    <option value="3">Burkina Faso</option>
                                    <option value="4">Burundi</option>
                                    <option value="5">Cameroon</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Street address <span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    placeholder="House number and street name" required />
                                <input type="text" class="form-control"
                                    placeholder="Apartment, suite, unit, etc. (optional)" required />
                            </div>

                            <div class="form-group">
                                <label>Town / City <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>State / Country <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>Postcode / ZIP <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group mb-3">
                                <label>Phone <span class="required">*</span></label>
                                <input type="number" class="form-control" required />
                            </div>

                            <div class="form-group mb-3">
                                <label>Email address <span class="required">*</span></label>
                                <input type="email" class="form-control" placeholder="editor@gmail.com"
                                    required />
                            </div>

                            <div class="form-footer mb-0">
                                <div class="form-footer-right">
                                    <button type="submit" class="btn btn-dark py-4">
                                        Save Address
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="shipping" role="tabpanel">
                    <div class="address account-content mt-0 pt-2">
                        <h4 class="title mb-3">Shipping Address</h4>

                        <form class="mb-2" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name <span class="required">*</span></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company </label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="select-custom">
                                <label>Country / Region <span class="required">*</span></label>
                                <select name="orderby" class="form-control">
                                    <option value="" selected="selected">British Indian Ocean Territory
                                    </option>
                                    <option value="1">Brunei</option>
                                    <option value="2">Bulgaria</option>
                                    <option value="3">Burkina Faso</option>
                                    <option value="4">Burundi</option>
                                    <option value="5">Cameroon</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Street address <span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    placeholder="House number and street name" required />
                                <input type="text" class="form-control"
                                    placeholder="Apartment, suite, unit, etc. (optional)" required />
                            </div>

                            <div class="form-group">
                                <label>Town / City <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>State / Country <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-group">
                                <label>Postcode / ZIP <span class="required">*</span></label>
                                <input type="text" class="form-control" required />
                            </div>

                            <div class="form-footer mb-0">
                                <div class="form-footer-right">
                                    <button type="submit" class="btn btn-dark py-4">
                                        Save Address
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .row -->
    </div>

@endsection

@push('js')

@endpush