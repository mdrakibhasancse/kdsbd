@extends('admin::layouts.adminMaster')
@section('title')
    | Deal Details
@endsection

@push('css')
@endpush

@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header py-2">
                    <h3 class="card-title text-bold text-muted pt-1"><i
                    class="fas fa-eye text-primary"></i> Deal Details (Deal Name: {{ $deal->title}}) - (DealId: &nbsp;  {{$deal->id }})</h3>
                    <div class="card-tools w3-small">
                        <a href="{{ route('admin.dealProductModalOpen', ['deal' => $deal, 'branch' =>$branch, 'deal-product-modal-open']) }}"
                        class="btn btn-primary btn-sm deal-product-modal-open"><i
                        class="fa fa-plus-square"></i>&nbsp;Add Product</a>
                    </div>
                </div>
            </div>

            <div class="card w3-round mb-2 shadow-lg">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#SL</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Unit</th>
                            <td style="width:20px;">Action</td>
    
                        </tr>
                    </thead>
                    <tbody class="productItems">
                        @include('product::admin.branches.deals.includes.items')
                    </tbody>
                    
                </table>
            </div>
            </div>
           
        </div>
    </div>
</section>


@include('product::admin.branches.deals.modals.modalLg')
   
@endsection


@push('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( document ).ready(function() {
       


        $(document).on('click', '.deal-product-modal-open', function(e) {
            e.preventDefault();
            var that = $(this),
                url = that.attr("href");
            $("#myModalLg").modal({
                backdrop: false
            });
            $.ajax({
                url: url,
                type: "Get",
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $(".modal-feed").show();
                },
                complete: function() {
                    $(".modal-feed").hide();
                },
            }).done(function(data) {

                $('#modalLargeFeed').empty().append(data);

            }).fail(function() {});
        });


        $(document).on('keyup', '.brandProductSearchAjax', function(e) {
            e.preventDefault();
            var that = $(this);
            var q = that.val();
            var url = that.attr('data-search-url');
            
            $.ajax({
                url: url,
                data : {q:q},
                method: "GET",
                success: function (response) {
                    $(".showProducts").empty().append(response.view);
                }
            });
        });

        
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
           
            $.ajax({
                url: url,
                method: "GET",
                success: function (response) {
                    $(".showProducts").empty().append(response.view);
                }
            });
        });


       



        $(document).on("change", ".input-select-item", function (e) {
            if (this.checked) {
                var that = $(this);
                var url = that.attr("data-select-url");
                // alert(url);
                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    success: function (response) {
                        $(".productItems").empty().append(response.view);
                    },
                    error: function () {
                    }
                });
            }else {
                var that = $(this);
                var url = that.attr("data-unselect-url");
                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    success: function (response) {
                         $(".productItems").empty().append(response.view);
                    },
                    error: function () {
                    }
                });

            } 
        });
    });

    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();
</script>





@endpush




