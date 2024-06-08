@extends('admin::layouts.adminMaster')
@section('title')
    | pos
@endsection

@push('css')
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
                <a href="{{ route('admin.posModuleDelete', ['branch'=> $branch, 'module'=> $module]) }}"><i class="fa fa-times pt-2"></i></a>
            </div>
            </div><!-- /.card-header -->

            <div class="card-body w3-light-gray pb-0 px-2 pt-2">
                <div class="row">
                    <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-9">
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

                                        <div class="col-md-3">
                            
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

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-right py-1">
                                <a href="{{ route('admin.posOrdersReport')}}" class="btn btn-info btn-sm"><i class="fab fa-first-order"></i>&nbsp;Pos Orders All</a>
                            </div>
                            <div class="table-responsive posItemModule">
                            <form action="{{ route('admin.posOrderStore',['branch' => $branch, 'module' => $module])}}" method="post" class="mobile-check-form" id="mobile-create-form">
                                @csrf
                                <table class="table table-no-pm table-condensed table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Sale Price</th>
                                        <th class="text-center">Total Amount</th>
                                        <th width="180">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="moduleItems">
                                        @include('product::admin.pos.includes.moduleItems')
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                        <th colspan="6" class="text-right">Sub Total (TK)</th>
                                        <th colspan="3" class="w3-light-gray p-0">
                                        <div class="form-group form-group-sm mb-0">
                                        <input type="number" name="sub_total" placeholder="Sub Total" step="any" value="{{ $module->moduleItemSubTotal() }}" class="form-control sub_total" id="sub_total" readonly="">
                                        </div>
                                        </th>
                                        </tr>


                                        <tr>
                                        <th colspan="6" class="text-right">Mobile</th>
                                        <th colspan="3" class="w3-light-gray p-0">
                                        <div class="form-group form-group-sm mb-0">
                                            <input type="text" id="mobile" name="mobile" class="form-control input-mobile w3-medium" value="{{ old('mobile')}}" id="mobile" placeholder="Enter Mobile">
                                            <span class="error_validation text-danger"></span>
                                        </div>
                                        <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}">
                                        </th>
                                        </tr>
                                        
                                        <tr>
                                        <th colspan="6" class="text-right">Discount (TK)</th>
                                        <th colspan="3" class="w3-light-gray p-0">
                                        <div class="form-group form-group-sm mb-0 module">
                                        <input type="number" name="discount" placeholder="Final Discount" class="form-control moduleDiscountAmount" value="" id="discount">
                                        </div>
                                        </th>
                                        </tr>

                                        <tr>
                                        <th colspan="6" class="text-right">Grand Total (TK)</th>
                                        <th colspan="3" class="w3-light-gray p-0">
                                        <div class="form-group form-group-sm mb-0">
                                        <input type="number" name="grand_total" placeholder="Grand Total" step="any" value="{{ $module->moduleItemSubTotal() }}" class="form-control sub_total" id="grand_total" readonly="">
                                        </div>
                                        </th>
                                        </tr>

                                        <tr>
                                        <th colspan="6" class="text-right">Paid (TK)</th>
                                        <th colspan="3" class="w3-light-gray p-0">
                                        <div class="form-group form-group-sm mb-0">
                                        <input type="number" name="paid_amount" placeholder="Paid Amount" min="0" step="any" class="form-control modulePaidAmount" id="paid_amount" required>
                                        @error('paid_amount')
                                            <span class="text-danger">{{ $message }}</span> 
                                        @enderror
                                         <span class="error_message text-danger"></span>
                                        </div>
                                        
                                        </th>
                                        </tr>

                                        <tr>
                                        <th colspan="6" class="text-right">Return (TK)</th>
                                        <th colspan="3" class="w3-light-gray p-0">
                                        <div class="form-group form-group-sm mb-0">
                                        <input type="number" name="return_amount" placeholder="Return Amount" step="any" value="" class="form-control return_amount" id="return_amount" readonly="">
                                        </div>
                                        </th>
                                        </tr>



                                        <tr>
                                        <th colspan="6" class="text-right"></th>
                                        <th colspan="3" class="w3-light-gray p-0 text-center">
                                        
                                            <button type="submit" 
                                            class="btn btn-sm px-5 save-btn btn-primary" >&nbsp;Save</button>


                                            {{-- <a class="btn btn-sm btn-success save-and-print-btn" value="save-and-print-btn"> &nbsp;Save And Print</a> --}}

                                            {{-- <a href="{{ route('admin.posOrderStoreAndPrint',['branch' => $branch, 'module' => $module])}}" class="btn btn-sm posOrderStoreAndPrint btn-success" >&nbsp;Save and Print</a> --}}
                                    

                                    
                                        </th>
                                        </tr>



                                    </tfoot>
                                
                                    

                                </table>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </section>
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
                document.getElementById('mobile-create-form').submit();
            } else {
                if (phoneInput.isValidNumber()) {
                
                    $('#valid_mobile').val(phoneNumber);
                    document.getElementById('mobile-create-form').submit();
                } else {
                    $(".error_validation").html('Invalid Mobile Number');
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



        // $(function() {
        //     $(document).on('click', ".save-and-print-btn", function(e) {
        //         e.preventDefault();
        //         var that = $(this);
        //         var phoneNumber = phoneInput.getNumber();
        //         alert()
        //         if (phoneInput.isValidNumber()) {
        //             var mobile = Number(that.closest('.posItemModule').find('#valid_mobile').val());
                   
        //         } 
             
        //         alert(mobile);
               
        //     });
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


    });
</script>
@endpush


