<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>
                    <a href="javascript:void(0)">Categories</a>
                    <ul>
                        @foreach ($cats as $cat)
                        <li><a href="{{ route('category', $cat->slug)}}">{{$cat->name_en}}</a></li>
                        @endforeach
                    </ul>
                </li>
                
                <li>
                    <a href="javscript:void(0)">My Account</a>
                    <ul>
                        @if(Auth::check())
                        <li>
                            <a href="{{route('user.dashboard')}}">My Dashboard</a>
                        </li>

                            @if(Auth::user()->hasRole('admin'))
                                <li><a href="{{ route('admin.dashboard')}}" >
                                Admin Dashboard
                                </a>
                                </li>
                            @endif


                            <li>
                                <a href="javascript:void(0)" onclick="$('#logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                            {{-- <li>
                                <a href="forgot-password.html">Forgot Password</a>
                            </li> --}}


                        @else
                        <li>
                            <a class="btn w3-indigo btn-block" data-target="#modal_register"  data-toggle="modal" >
                                Checkout
                            </a>
                        </li>
                        @endif
                        
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End .mobile-nav -->

        <form class="search-wrapper mb-2" action="#">
            <input type="text" class="form-control mb-0" placeholder="Search..." required />
            <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
        </form>
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>