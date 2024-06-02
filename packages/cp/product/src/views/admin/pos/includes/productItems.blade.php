
@forelse($products as $product)
<div class="col-md-3 col-sm-4 col-5">
    <div class="w3-display-container product-container  w3-animate-zoom">
        <div class="card card-widget">

         
            <img class="img-fluid card-img-top" src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $product->fi()]) }}" alt="{{$product->name_en}}">
            
            <div class="card-body p-0">
                <h3 class="w3-small font-weight-bold pl-1 pb-0 pt-2">
                    {{Str::Limit($product->name_en , 15 , '...')}}
                </h3>
                    

                <div class="w3-small pl-1 pb-2 fontent-weight-bold">
                    BDT {{$product->final_price}}
                </div>

                
              <?php $module = $branch->moduleActive() ?>
              <form method="post" class="form-add-module-item" action="{{ route('admin.addModuleItem', ['module'=>$module, 'branch'=>$branch]) }}">
                @csrf
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <div class="w3-display-bottomright w3-large">
                    <button type="submit" class="btn">
                        <i class="fas fa-cart-plus w3-large text-primary"></i>
                    </button>
                </div>
              </form>

            </div>
        </div>
    </div>
</div>
@empty
@endforelse