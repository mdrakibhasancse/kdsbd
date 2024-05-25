<div class="product-default bg-white w3-border w3-hover-border-indigo mx-1 py-3">
    <figure>
        <a href="{{route('product', ['slug' => $product->slug, 'id' => $product->id])}}">
        <img src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}" alt="product">
        <img src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $product->fi()]) }}"  alt="product">
        </a>

        <div class="label-group">
        @if($product->discount > 0.00)
        <div class="product-label label-hot w3-deep-orange">Tk. {{$product->discount}} off</div>
        @endif
        </div>
    </figure>

    <div class="product-details">
        <h3 class="product-title"> <a href="{{route('product', ['slug' => $product->slug, 'id' => $product->id])}}">{{Str::Limit($product->name_en , 20 , '...')}}</a> </h3>
        <span class="font-weight-bold w3-text-gray pb-1">
        {{$product->unit}}
        </span>
        <div class="price-box">
        @if($product->discount > 0.00)
        <span class="old-price w3-small">Tk. {{$product->price}}</span>
        @endif
        <span class="product-price w3-small font-weight-bold">Tk. {{ $product->final_price }}</span>
        </div><!-- End .price-box -->

        <div class="product-action ">
       
       
        @if(request()->cookie('area_name') != null)

        <div class="productCartItem">
           @include('frontend::welcome.includes.productCartItem')
        </div>

        @else
        <a class="btn-icon px-5 py-2 w3-button w3-round w3-deep-orange w3-hover-indigo font-weight-bold w3-small" data-target="#myModalLg"  data-toggle="modal" style="line-height: 30px">
            <i class="icon-shopping-cart"></i>&nbsp;<span>ADD TO CART</span></a>
        </a>
        @endif
        </div>
    </div><!-- End .product-details -->
</div>