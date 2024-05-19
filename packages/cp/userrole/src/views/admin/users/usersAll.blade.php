@extends('admin::layouts.adminMaster')
@section('title')
    | Users All
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
     
@endpush

@section('content') 

    <section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                            class="fas fa-sitemap text-primary"></i> Users</h3>
                    <div class="card-tools w3-small">

                        <a href="" class="btn-create-from btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i> Create New</a>
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg card-create-form-toggle">
                <div class="card-body px-3 py-1 w3-light-gray">
                    <form class="user-mobile-check-form" action="{{route('admin.userStore')}}" method="POST" enctype="multipart/form-data" id="user-create-form">
                        @csrf
                        <div class="form-row ">
                            <div class="form-group  w3-small col-md-4">
                                <label class="text-muted" for="name">Name </label>
                                <input type="text" name="name" value="{{ old('name')}}" id="name" placeholder="Name"  class="form-control" required>
                                @error('name')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         
                            <div class="form-group  w3-small col-md-4 mb-0">
                                <label class="text-muted" for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control w3-tiny"> 
                            </div>

                            <div class="form-group  w3-small col-md-4">
                              <label class="text-muted" for="email">Email</label>
                              <input type="email" name="email" value="{{ old('email')}}" id="email" class="form-control"
                              placeholder="Email" required>
                              @error('email')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            
                            
                              <div class="form-group  w3-small col-md-4">
                                <label class="text-muted" for="mobile">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control input-mobile"value="{{ old('mobile')}}">
                              
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}">



                            <div class="form-group  col-md-4 w3-small">
                              <label class="text-muted" for="password">Password</label>
                              <input type="password" name="password" value="{{ old('password')}}" id="password" class="form-control"
                              placeholder="password" required>
                              @error('password')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>


                            <div class="form-group  w3-small col-md-2 mt-1">
                                <label for=""> &nbsp; </label>
                                <button type="submit" class="btn btn-primary btn-xs btn-block py-2">Submit</button>
                            </div>

                        </div>
          
                    </form>
                </div>
            </div>
            <div class="card w3-round shadow-lg">
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-th text-primary pt-1"></i> All Users</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="search" name="q" class="user-search form-control border-right-0 border py-2" data-url="{{ route('admin.userSearch') }}"  placeholder="Search name, email, mobile, id...">
                            <div class="input-group-append ">
                                <button type="submit" class="input-group-text bg-transparent">
                                <i class="fa fa-search w3-text-orange"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                        <div class="table-responsive table-responsive-sm data-container">
                            @include('userrole::admin.users.searchData')
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection



@push('js')
    <script>
        function getIp(callback) {
            var ip = $(".ip").val();
            var infoUrl = 'https://ipinfo.io/json?ip=' + ip;
            fetch(infoUrl, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then((resp) => resp.json())
                .catch(() => {
                    return {
                        country: '',
                    };
                })
                .then((resp) => callback(resp.country));
        }
        const phoneInputField = document.querySelector(".input-mobile");
        const phoneInput = window.intlTelInput(phoneInputField, {
         
            initialCountry: "bd",
            geoIpLookup: getIp,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            preferredCountries: ["bd", "us", "gb"],
            placeholderNumberType: "MOBILE",
            nationalMode: true,
        
            customContainer: "w-100",
            autoPlaceholder: "polite",
        });

     
   
    </script>

    <script type="text/javascript">
       
        $(document).ready(function () {
            $(document).on("submit", ".user-mobile-check-form", function(e) {
                e.preventDefault();
                var that = $(this);
                var formData = that.serialize();
                if (phoneInput.isValidNumber()) {
                    $('#valid_mobile').val(phoneInput.getNumber());
                        document.getElementById('user-create-form').submit();
                } else {
                    alert('Check Mobile Number Again');
                }
            }); 
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.pass-show', function(e){
                var that = $(this);
                if(that.hasClass('fa-eye-slash'))
                {
                that.removeClass('fa-eye-slash').addClass('fa-eye');
                that.closest('.input-group').find('#password').attr('type', 'text');

                }else
                {
                that.removeClass('fa-eye').addClass('fa-eye-slash');
                that.closest('.input-group').find('#password').attr('type', 'password');


                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('keyup', ".user-search", function(e){

                e.preventDefault();
                var that = $( this );
                var url = that.attr('data-url');
                var q = that.val();

                $.ajax({
                    url: url,
                    data : {q:q},
                    method: "get",
                    success: function(res)
                    {
                        if(res.success)
                        {
                            $(".data-container").empty().append(res.page);
                        }
                    }
                });
            });
        });
    </script>
@endpush
