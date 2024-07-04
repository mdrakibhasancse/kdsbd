<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>kdsbd</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="kdsbd">
    <meta name="author" content="SW-THEMES">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}">
    <link rel="icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Oswald:300,400']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="stylesheet" href="{{asset("https://www.w3schools.com/w3css/4/w3.css")}}">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset("/frontend/assets/css/bootstrap.min.css")}}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset("/frontend/assets/css/demo22.min.css")}}">
    {{-- <link rel="stylesheet" href="{{asset("/frontend/assets/css/style.min.css")}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset("/frontend/assets/vendor/fontawesome-free/css/all.min.css")}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('/')}}alt/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('/')}}alt/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

     <style>
        .header-search-inline .form-control {
            max-width: 500px !important;
        }
        .header-search-category .form-control {
            border-radius: 1rem 0 0 1rem !important;
        }

        .header-search-category .btn {
            border-radius: 0 1rem 1rem 0 !important;
        }

        .newsletter-popup {
            max-width: 485px !important;
        }

        @media (max-width: 991px) {
            .header-search-wrapper {
                height: 40px !important;
                border: 0px !important;
            }
        }

        .header-user i {
            line-height: 52px;
            text-align: center;
        }

        .select2-container .select2-selection--single {
            height: 38px !important;
        }

        .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
            padding-top: 0.5rem !important;
        }

        select.form-control:not([size]):not([multiple]) {
            height: 4rem !important;
        }

        
     </style>


     @stack('css')
</head>

<body class="loaded">
    <div class="page-wrapper">
        <header class="header box-shadow">
           <div class="header-top">
            <div class="container areaLocation">
                @include('frontend::welcome.includes.areaLocation')
            </div>
           </div>
        </header>


		@include('frontend::layouts.pageHeader') 

        <main class="main" style="background: #fafafa ">
           @include('sweetalert::alert')
           @yield('content')
        </main>
        
        <!-- End .main -->
        @include('frontend::layouts.frontendFooter')
       
    </div>
    

    @include('frontend::welcome.includes.mobileMenuContainer')

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="{{url('/')}}">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{route('categoriesAll')}}" class="">
                <i class="icon-bars"></i>Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="javascript:void(0)" class="">
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>



        <div class="sticky-info">

            @if(Auth::check())
            <a href="{{route('user.dashboard')}}"><i class="icon-user-2"></i>  Account</a>
            @else
            <a class="" data-target="#modal_register"  data-toggle="modal" style="cursor: pointer">
               <i class="icon-user-2"></i> Account
            </a>
            @endif

        </div>


        <div class="sticky-info">
            @if(Auth::check())
             <a href="{{ route('checkout')}}" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle totalCartItems">{{totalCartItems()}}</span>
                </i>Cart
            </a>
            @else
            
            <a  class="" data-target="#modal_register"  data-toggle="modal" >
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle totalCartItems">{{totalCartItems()}}</span>
                </i>Cart
            </a>
            @endif
        </div>
    </div>


    @include('frontend::welcome.includes.modals.modalLg')
    @include('frontend::welcome.includes.modals.registerModal')

    

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>
    <!-- Plugins JS File -->
    <script src="{{asset("/frontend/assets/js/jquery.min.js")}}"></script>
    <script src="{{asset("/frontend/assets/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("/frontend/assets/js/plugins.min.js")}}"></script>
    <script src="{{asset("/frontend/assets/js/optional/isotope.pkgd.min.js")}}"></script>
    <script src="{{asset("/frontend/assets/js/jquery.appear.min.js")}}"></script>
    <script src="{{asset("/frontend/assets/js/jquery.plugin.min.js")}}"></script>
    <script src="{{asset("/frontend/assets/js/jquery.countdown.min.js")}}"></script>
    <script src="{{asset("/frontend/assets/js/nouislider.min.js")}}"></script>

    <!-- Main JS File -->
    <script src="{{asset("/frontend/assets/js/main.min.js")}}"></script>


    <script src="{{ asset('alte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset('/')}}alt/plugins/select2/js/select2.full.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>



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
            $(document).on("submit", ".mobile-check-form", function(e) {
                e.preventDefault();
                var that = $(this);
                var url  = that.attr('data-url');
                var formData = that.serialize();
                if (phoneInput.isValidNumber()) {
                    $('#valid_mobile').val(phoneInput.getNumber());
                        document.getElementById('mobile-create-form').submit();
                } else {
                    // alert('Check Mobile Number Again');
                    $(".error_validation").html('Invalid Mobile Number');
                    
                }
            }); 

        });
    </script>

    <script>
        $(function(){
            @if(!request()->cookie('area_name'))
            setTimeout(function(e){
            $('#myModalLg').modal('show');
            }, 500);

            $('.select2').select2({
                theme: 'bootstrap4'

            });
            @endif
        });
    </script>

    <script>
        $(function(){
            @if(request()->cookie('mobile_saved')) 
            $("#modal_register").modal('show');
            @endif
        });
    </script>

    <script>
        $(document).ready(function(){
            //delete cart Item
            $(document).on("click",".cartRemoveItem",function() {
                var that = $(this);
                var url  = that.attr('data-url');
                var result = confirm('Are you sure to delete this cart item?');
                if(result){
                    $.ajax({
                    url    : url,
                    method : "post",
                    success: function(result){
                        $(".headerCart").empty().append(result.view);
                        $(".checkoutItems").empty().append(result.checkoutItems);
                        $(".chekoutBtn").empty().append(result.chekoutBtn);
                        that.closest('.product-details').find(".productCartItem").empty().append(result.productCartItem);
                        $(".totalCartAmount").html(result.totalCartAmount);
                        $(".totalDiscountCartAmount").html(result.totalDiscountCartAmount);
                        $(".totalOriginalCartAmount").html(result.totalOriginalCartAmount);
                        $(".totalCartItems").html(result.totalCartItems);
                        location.reload();

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: result.message
                        });
                        
                    },error:function(){
                        alert("Error");
                    }
                });
                }
            });

    
            $(document).on('submit', '.sendOtpMatch', function(e) {
                e.preventDefault();
                var that = $(this);
                var q = that.val();
                var url = that.attr('action');
                var type = that.attr('method');
                var data = new FormData(this);
                $.ajax({
                    url: url,
                    type: type,
                    cache : false,
                    dataType    : 'json',
                    processData : false,
                    contentType: false,
                    data: new FormData(this),
                    success: function(result){
                        if(result.success == true){
                            $(".sendOtpMatchData").empty().append(result.page);  
                        }else if(result.loginSuccess == true){
                            window.location.href = '/checkout';
                        }else{
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: result.message
                            });
                        }
                        
                    }
                });
            })

           
        });

    </script>

    <script>
        $(document).ready(function () {
            $(document).on('keyup', ".search", function(e){
            e.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            var q = that.val();
            $.ajax({ 
                url: url,
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token for security
                    q: q
                },
                cache: false,
            }).done(function(response) {
                that.closest('.container').find('.searchResults').empty().append(response.view);
                var newRoute = '{{ route("search") }}';
                history.pushState({ path: newRoute }, '', newRoute + '?q=' + encodeURIComponent(q));
                location.reload();
            });
        });
        });
    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function () {
            var branches = <?php echo json_encode($branches); ?>;
            var areas = <?php echo json_encode($areas); ?>

            $(document).on("change", ".branch-select", function (e) {
                e.preventDefault();

              
                var that = $(this);
                var q = that.val();
                
                that.closest('form').find(".area-select").empty().append($('<option>', {
                    value: '',
                    text: 'select your area'
                }));


                $.each(areas, function (i, item) {
                    if (item.branch_id == q) {
                        that.closest('form').find(".area-select").append(
                            "<option value='" + item.id + "'>" + item.name_en +
                            "</option>");
                    }
                });
            });

        });
    </> --}}

    @stack('js')
</body>

</html>