@extends('admin::layouts.adminMaster')
@section('title')
    | pos
@endsection

@push('css')
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
                                    <div class="form-group">
                                        <div class="input-group input-group-md">
                                            <input type="search" class="form-control form-control-md   pos-product-search" data-search-url="{{route('admin.PosProductSearch', ['branch'=>$branch])}}" placeholder="Search here..." aria-label="Search" name="q" autocomplete="off" autofocus="">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-md btn-default bg-white">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row productItems">
                                        @include('product::admin.pos.includes.productItems')
                                    </div>

                                    <div class="row mt-4 justify-content-center">
                                        <div class="col text-center">
                                            <button data-next-page="{{$products->nextPageUrl()}}" style="width: 200px" class="w3-btn w3-white w3-border w3-border-red w3-round text-danger px-5 font-wight-bold tap-to-see-more"><b>LOAD MORE</b></button>
                                                
                                            <span class="spinner-border w3-text-red spinner-border-lg load-more-loader" style="display:none;"></span>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            
                        
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="table-responsive moduleItems">
                              @include('product::admin.pos.includes.moduleItems')
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

        $(document).on('keyup', '.pos-product-search', function(e) {
            e.preventDefault();
            var that = $(this);
            var q = that.val();
            var url = that.attr('data-search-url');
            
            $.ajax({
                url: url,
                data : {q:q},
                method: "GET",
                success: function (response) {
                    $(".productItems").empty().append(response.view);
                    $('.tap-to-see-more').hide();
                }
            });
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
                    $(".sub_total").html(response.subTotal);
                }).fail(function(){
                    alert('error');
                });
        });


        $(function() {
            $(document).on('keyup', ".moduleDiscountAmount", function(e) {
                var that = $(this);
                var discount = Number(that.val());
                var subTotal = that.closest('.moduleItems').find('.sub_total').val();
                var grandTotal = subTotal - discount;
                grandTotal = grandTotal.toFixed(2);
                $(".grand_total").val(grandTotal);
            });
        });

        $(function() {
            $(document).on('keyup', ".modulePaidAmount", function(e) {
                var that = $(this);
                var paid = Number(that.val());
                var grandTotal = that.closest('.moduleItems').find('.grand_total').val();
                if (paid > grandTotal) {
                    returnAmount =  paid - grandTotal;
                    $(".return_amount").val(returnAmount);
                 }else{
                    $(".return_amount").val('0.00');
                 } 
            });
        });



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
                    $(".sub_total").html(result.subTotal);
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
                    $(".sub_total").html(result.subTotal);
                },error:function(){
                    alert("Error");
                }
            });
            
        });


    });
</script>
@endpush


