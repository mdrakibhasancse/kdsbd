@extends('admin::layouts.adminMaster')
@section('title')
    | pos
@endsection

@push('css')
<style>
   
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@endpush

@section('content') 
    <!-- Main content -->
    <section class="content p-2">
        <div class="card w3-animate-zoom">
            <div class="card-header py-0">
            <div class="card-title">
                <ul class="nav nav-pills m-0 p-0">
                @foreach($branch->saleModuleAuth() as $module)
                <li class="nav-item">
                    <a class="nav-link pr-3 py-1 font-weight-bold {{ $module->active ? 'active' : '' }}" href="{{ route('admin.posModuleMakeActive', ['branch'=> $branch, 'module'=>$module]) }}" style="border-radius: 0px;">{{ $loop->iteration }}</a>
                </li>
                @endforeach

                <li><a href="{{ route('admin.posModuleAnother', $branch) }}" class="pl-3"><i class="fa fa-plus pt-2"></i></a></li>
                
                </ul>
            </div>
            
            <?php $module = $branch->moduleActive() ?>
            <div class="card-tools">
                <form action="{{ route('admin.getUser',['branch' => $branch, 'module' => $module])}}" method="post" style="display:inline-block" class="mobile-check-form mb-0 pb-0" id="mobile-create-form">
                    @csrf
                    <div class="d-flex">
                    <input type="text" class="form-control form-control-sm input-mobile" value="{{$module->mobile }}" placeholder="Enter Mobile" style="border-radius: 0px;">
                    <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile') }}">
                    <button class="btn btn-success btn-sm" style="border-radius: 0px;">Submit</button>
                    </div>
                    
                </form>
                

                
              
                @if($module->user_id)
                   <a href="{{ route('admin.usersAll', ['id' => $module->user_id]) }}" class="btn btn-sm btn-primary" id="useridHide">{{$module->user_id}}</a>
                   <a href="{{ route('admin.posOrdersReport', ['id' => $module->user_id]) }}" class="btn btn-sm btn-primary" id="userOrdersHide">User Orders</a>
                @elseif(!$module->user_id && $module->mobile)
                    <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalLg" id="userModalHide">
                        <i class="fa fa-user-plus"></i>
                    </a>
                @endif

                <span id="userid"></span>
                <span id="userOrders"></span>
                <span id="userModal"></span>

                &nbsp;
                <a href="{{ route('admin.posOrdersReport')}}" class="btn btn-info btn-sm"><i class="fab fa-first-order"></i>&nbsp;&nbsp;Pos Orders All</a>
                &nbsp;
                <a href="{{ route('admin.branchArea', $branch)}}" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Branch</a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{ route('admin.posModuleDelete', ['branch'=> $branch, 'module'=> $module]) }}"><i class="fa fa-times pt-2"></i></a>
            </div>
            </div><!-- /.card-header -->

            <div class="card-body w3-light-gray pb-0 px-2 pt-2">
                <div class="row">
                    <div class="col-md-5">
                            <div class="card" style="overflow-y: scroll;height:auto;max-height:530px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="input-group input-group-md">
                                                    <input type="search" class="form-control form-control-md pos-product-search" data-search-url="{{route('admin.PosProductSearch', ['branch'=>$branch])}}" placeholder="Search here..." aria-label="Search" name="q" autocomplete="off" autofocus="">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-md btn-default bg-white">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                            
                                        <input type="search" class="form-control form-control-md ajaxProductItemStore" data-url="{{route('admin.ajaxProductItemStore', ['branch'=>$branch ,'module'=>$module])}}" placeholder="Product Code Here..." aria-label="Search" name="q" autocomplete="off" autofocus="">
                                        
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row productItems">
                                        @include('product::admin.pos.includes.productItems')
                                    </div>

                                    {{-- <div class="row mt-4 justify-content-center">
                                        <div class="col text-center">
                                            <button data-next-page="{{$products->nextPageUrl()}}" style="width: 200px" class="w3-btn w3-white w3-border w3-border-red w3-round text-danger px-5 font-wight-bold tap-to-see-more"><b>LOAD MORE</b></button>
                                                
                                            <span class="spinner-border w3-text-red spinner-border-lg load-more-loader" style="display:none;"></span>
                                        </div>


                                    </div> --}}

                                </div>
                            </div>
                            
                        
                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered shadow-lg table-sm">
                                    <thead class="w3-small">
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th class="text-center" width="75">Quantity</th>
                                        <th class="text-center" width="75">Sale Price</th>
                                        <th class="text-center" width="90">Total Amount</th>
                                        <th width="20">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="moduleItems w3-small">
                                        @include('product::admin.pos.includes.moduleItems')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-2">
                        <div class="card">
                        <form action="{{ route('admin.posOrderStore',['branch' => $branch, 'module' => $module])}}" method="post">
                            @csrf
                            <div class="card-body posItemModule">        
                                <div class="form-group form-group-sm mb-2">
                                <label for="" class="mb-1">Sub Total</label>
                                <input type="number" name="sub_total" placeholder="Sub Total" step="any" value="{{ $module->moduleItemSubTotal() }}" class="form-control sub_total" id="sub_total" readonly="">
                                </div>
                                        
                                {{-- <div class="form-group form-group-sm mb-2">
                                    <label for="" class="mb-1">Mobile</label>
                                    <input type="text" id="mobile" name="mobile" class="form-control input-mobile w3-medium getUserId" value="{{ old('mobile')}}" id="mobile" placeholder="Enter Mobile">
                                    <span class="error_validation text-danger"></span>
                                </div>
                                <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}"> --}}
                                        
                                        
                                        
                                <div class="form-group form-group-sm module mb-2">
                                <label for="" class="mb-1">Discount (TK)</label>
                                <input type="number" name="discount" placeholder="Final Discount" class="form-control moduleDiscountAmount" value="" id="discount">
                                </div>
                                        
                                    
                                <div class="form-group form-group-sm mb-2">
                                <label for="" class="mb-1">Grand Total (TK)</label>
                                <input type="number" name="grand_total" placeholder="Grand Total" step="any" value="{{ $module->moduleItemSubTotal() }}" class="form-control sub_total" id="grand_total" readonly="">
                                </div>
                                        
                                
                                <div class="form-group form-group-sm mb-2">
                                <label for="" class="mb-1">Paid (TK)</label>
                                <input type="number" name="paid_amount" placeholder="Paid Amount" min="0" step="any" class="form-control modulePaidAmount" id="paid_amount" required>
                                @error('paid_amount')
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                                <span class="error_message text-danger"></span>
                                </div>
                                
                                <div class="form-group form-group-sm mb-2">
                                <label for="" class="mb-1">Return (TK)</label>
                                <input type="number" name="return_amount" placeholder="Return Amount" step="any" value="" class="form-control return_amount" id="return_amount" readonly="">
                                </div>
                                        

                                {{-- <button type="submit" 
                                class="btn btn-sm px-5 save-btn btn-primary btn-block" >&nbsp;Save</button> --}}

                                {{-- <input type="submit" name="submit" class="btn btn-sm px-5 save-btn btn-primary btn-block" value="Save">

                                <input type="submit" class="btn btn-sm px-5 save-btn btn-success btn-block" name="submit" value="save_and_print"> --}}

                                <button type='submit' name="submit" value="save"  id="print" class="btn btn-sm px-5 btn-primary btn-block"> Save
                                </button> 
    
                                <button type='submit' name="submit" value="save_and_print"  id="export" class="btn btn-info btn-sm btn-block"> Save And Print
                                </button>

                                {{-- <button type="submit" class="btn btn-sm btn-success btn-block" id="save-print-btn" data-url="{{ route('admin.posOrderStoreAndPrint',['branch' => $branch, 'module' => $module])}}">&nbsp;Save And Print</button> --}}

                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </section>
    @include('product::admin.pos.modals.modalLg')
@endsection



@push('js')
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
            var url = that.attr('data-url');
            var formData = that.serialize();
            var phoneNumber = phoneInput.getNumber();
            if (!phoneNumber) {
                alert('Invalid Mobile Number');
            } else {
                if (phoneInput.isValidNumber()) {
                     $.ajax({
                        url: that.attr("action"),
                        cache: false,
                        type : that.attr('method'),
                        data : { mobile : phoneInput.getNumber()},
                        dataType: 'json',
                        success: function(response)
                        {
                            if(response.user)
                            {
                                var user = response.user.id;
                                var userUrl = "{{ route('admin.usersAll') }}?id=" + user;
                                var button = $('<a>', {
                                    href: userUrl,
                                    class: 'btn btn-sm btn-primary',
                                    text: response.user.id
                                });

                                $('#userid').empty().append(button);

                                var user = response.user.id;
                                var userOrderUrl = "{{ route('admin.posOrdersReport') }}?id=" + user;
                                var button = $('<a>', {
                                    href: userOrderUrl,
                                    class: 'btn btn-sm btn-primary',
                                    text: 'User Orders'
                                });
                              
                                $('#userOrders').empty().append(button);

                                $("#userOrders").show();
                                $("#userid").show();
                                $("#userModal").hide();
                                $("#userOrdersHide").hide();
                                $("#useridHide").hide();
                                $("#userModalHide").hide();
                             

                            }else{
                                $('#userModal').empty().append(`<a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalLg">
                                <i class="fa fa-user-plus"></i>
                                </a>  `);
                                $("#userModal").show();
                                $("#userOrders").hide();
                                $("#userid").hide();
                                $("#userModalHide").hide();
                                $("#userOrdersHide").hide();
                                $("#useridHide").hide();
                            }
                        },
                        error: function(){}
                    });
                } else {
                    alert('Invalid Mobile Number');
                }
            }
        });

    });
</script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();


    $( document ).ready(function() {
        $(document).on('click','.tap-to-see-more', function(e){
            e.preventDefault();
            var that = $( this );
            $('.load-more-loader').show();
            $('.tap-to-see-more').hide();
            var urlNext = that.attr('data-next-page');
            $.ajax({ 
                url: urlNext ,
                type:"get",
                cache:false,
                }).done(function(response) {
                that.attr('data-next-page', response.next_page_url);
                $('.productItems').append(response.view);
                $('.load-more-loader').hide();
                $('.tap-to-see-more').show();
                if(response.next_page_url == null)
                {
                    that.hide();
                    $(".reached-at-end").show();
                }
            });      
        }); 



        $(document).on('keyup', '.pos-product-search', function(e){
            var that = $(this);
            var q = that.val();
            var url = that.attr('data-search-url');
            delay(function(){    
            $.ajax({
                url: url,
                data : {q:q},
                method: "GET",
            })
            .done(function(response) {
                $(".productItems").empty().append(response.view);
            })
            .fail(function() {});
            }, 800);
        });

        

        $(document).on('submit','.form-add-module-item',function(s){
            s.preventDefault();
            var form = $(this),
            url = form.attr('action'),
            type = form.attr('method'),
            alldata = new FormData(this);

            $.ajax({
                url: url,
                type: type,
                data: alldata,
                contentType: false,
                cache: false,
                processData:false,
                }).done(function(response){
                    
                    $(".moduleItems").empty().append(response.view);
                    $(".sub_total").val(response.subTotal);
                }).fail(function(){
                    alert('error');
                });
        });


        $(document).on('keyup','.ajaxProductItemStore',function(s){
            s.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            var val = that.val();
          
            $.ajax({
                url: url,
                type: "get",
                data: {q : val},
                }).done(function(response){
                    console.log(response.view);
                    $(".moduleItems").empty().append(response.view);
                    //   that.closest('.posItemModule').find(".moduleItems").empty().append(response.view);
                    $(".sub_total").val(response.subTotal);
                }).fail(function(){
                    alert('error');
                });
        });


        $(function() {
            $(document).on('keyup', ".moduleDiscountAmount", function(e) {
                var that = $(this);
                var discount = Number(that.val());
                var subTotal = that.closest('.posItemModule').find('.sub_total').val();
                var grandTotal = subTotal - discount;
                grandTotal = grandTotal.toFixed(2);
                $("#grand_total").val(grandTotal);
            });
        });

        $(function() {
            $(document).on('keyup', ".modulePaidAmount", function(e) {
                var that = $(this);
                var paid = Number(that.val());
                var grandTotal = that.closest('.posItemModule').find('#grand_total').val();
                if (paid > grandTotal) {
                    returnAmount =  paid - grandTotal;
                    $("#return_amount").val(returnAmount);
                 }else{
                    $("#return_amount").val('0.00');
                 } 
            });
        });



       

        
        // $(document).on("click", "#save-print-btn", function(e) {
        //     e.preventDefault();
        //     var form = $('.mobile-check-form');
        //     var that = $(this);
        //     var url = that.attr('data-url');
        //     var formData = form.serialize();
        //     var alldata = new FormData(this);
        //     var phoneNumber = phoneInput.getNumber();
           
        //     if (!phoneNumber) {
        //         $(".error_validation").html('Phone number is required');
        //     } else {
        //         // Validate the phone number
        //         if (phoneInput.isValidNumber()) {
        //             // Set the valid phone number
        //             $('#valid_mobile').val(phoneNumber);

        //             // Perform an AJAX request instead of form submission
        //             $.ajax({
        //                 type: "POST",
        //                 url: url,
        //                 data: alldata,
        //                 contentType: false,
        //                 cache: false,
        //                 processData:false,
        //                 success: function(response) {
                           
        //                     console.log('Success:', response);
        //                     // You can redirect or update the UI accordingly
        //                 },
        //                 error: function(error) {
        //                     // Handle error response
        //                     console.log('Error:', error);
        //                     $(".error_validation").html('An error occurred while submitting the form');
        //                 }
        //             });
        //         } else {
        //             // Display error message if the phone number is invalid
        //             $(".error_validation").html('Invalid Mobile Number');
        //         }
        //     }
        // });



      


        $(document).on("click",".moduleUpdateItem",function(s) {
            s.preventDefault();
            var that = $( this );
            var url  = that.attr('data-url');
            if(that.hasClass('plus')){
                var cart_qty  = that.attr('data-qty');
                new_qty = parseInt(cart_qty) + 1;
            }
            if(that.hasClass('minus')){
                var cart_qty  = that.attr('data-qty');
                if(cart_qty <=1 ){
                    return false;
                }
                new_qty = parseInt(cart_qty) - 1;
            }
            
            $.ajax({
                url    : url,
                method : "get",
                data   : { new_qty : new_qty},
                success: function(result){
                   $(".moduleItems").empty().append(result.view);
                   $(".sub_total").val(result.subTotal);
                },error:function(){
                    alert("Error");
                }
            });
        });



        $(document).on("click",".moduleRemoveItem",function(s) {
            s.preventDefault();
            var that = $(this);
            var url  = that.attr("href");
            // var result = confirm('Are you sure to delete this cart item?');
            $.ajax({
                url    : url,
                method : "get",
                success: function(result){
                    $(".moduleItems").empty().append(result.view);
                    $(".sub_total").val(result.subTotal);
                },error:function(){
                    alert("Error");
                }
            });
            
        }); 



        $(document).on('submit','.form-new-user-create',function(s){
            s.preventDefault();
            var form = $(this),
            url = form.attr('action'),
            type = form.attr('method'),
            alldata = new FormData( this );

            $.ajax({
                url: url,
                type: type,
                data: alldata,
                contentType: false,
                cache: false,
                processData:false,
    
            }).done(function(response){
        
                if(response.success == true)
                {
                
                    $("#myModalLg").modal('hide');

                    if(response.user){
                         var user = response.user.id;
                        var userUrl = "{{ route('admin.usersAll') }}?id=" + user;
                        var button = $('<a>', {
                            href: userUrl,
                            class: 'btn btn-sm w3-blue',
                            text: response.user.id
                        });

                        $('#userid').empty().append(button);

                        var user = response.user.id;
                        var userOrderUrl = "{{ route('admin.posOrdersReport') }}?id=" + user;
                        var button = $('<a>', {
                            href: userOrderUrl,
                            class: 'btn btn-sm w3-blue',
                            text: 'User Orders'
                        });
                        $('#userOrders').empty().append(button);

                        $("#userOrders").show();
                        $("#userid").show();

                        $("#userModal").hide();
                        
                        

                    }else{
                        $('#userModal').empty().append(`<a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalLg">
                        <i class="fa fa-user-plus"></i>
                        </a>`);
                        $("#userModal").show();
                        $("#userOrders").hide();
                        $("#userid").hide();
                    }

                    location.reload();

                }
                

            }).fail(function(){
                alert('error');
            });
        });


        

    });
</script>
@endpush


