
<!-- Modal content-->
<div class="modal-content w3-round">       
  <div class="modal-body-s">
    <div class="card card-widget">
      <div class="card-header with-border">
        <h3 class="card-title"><i class="fa fa-plus-circle"></i>&nbsp;{{__('Add Product Information')}}</h3>
        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
      </div>
      <div class="card-body w3-light-gray pb-0">
        <div class="row">
          <div class="col-12">
               <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">Add New Product</h3>
            </div>
            <!-- /.card-header -->
        
            <div class="card-body">
                <input type="text" class="form-control my-2 brandProductSearchAjax" 
                placeholder="Search for products.."
                data-search-url="{{route('admin.branchProductSearchAjax',['branch'=>$branch, 'order' => $order])}}" style="border: 2px  solid green;">

                <div class="showProducts">
                  @include('product::admin.orders.ajax.searchProducts')
                </div>

               
                
            </div>
            <!-- /.card-body -->
        </div>
          </div>
        </div>
      </div>

    <div class="overlay modal-feed"><i class="fas fa-2x fa-sync-alt fa-spin w3-xxxlarge w3-text-blue"></i>
    </div>

    </div>

</div>
</div>





