@if(Auth::check())           
    @if((totalCartAmount()) >= 1000)
    <div class="dropdown-cart-action">
        <a href="{{route('checkout')}}" class="btn w3-indigo btn-block">Checkout</a>
    </div>
    @else
    <div class="dropdown-cart-action-">
        <div class="card text-center mb-1">
         <div class="card-body">
            <p class="w3-large font-weight-bold pb-2">Orders below 1000tk are not accepted</p>
            <a href="{{url('/')}}" class="btn w3-indigo py-3 px-5 text-white" style=" text-decoration:none">Go Shop</a>
        </div> 
         </div>
       
    </div>
    @endif

    @else
    <div class="dropdown-cart-action-">
        <a  class="btn w3-indigo btn-block" data-target="#modal_register" data-toggle="modal">
            Checkout
        </a>
    </div>
@endif