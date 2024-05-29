<div class="header-left py-1">
    <a class="btn w3-light-gray rounded my-1 py-1 text-center w3-small" data-target="#myModalLg"  data-toggle="modal" >
        <strong><i class="fa fa-map-marker-alt w3-text-indigo"></i>
        <span>{{ request()->cookie('area_name') ?? 'select area'}}</span>
        </strong>
    </a>

    <a class="btn w3-light-gray rounded my-1 py-1 text-center d-none d-lg-block mx-1 w3-small">
        <strong>
        <span>Delivery in 100 min</span>
        </strong>
    </a>
</div><!-- End .header-dropdown -->

<div class="header-right ml-0 ml-lg-auto">
   
    <a class="btn w3-light-gray rounded my-1 py-1 text-center d-none d-lg-block w3-small">
        <strong>
        <span>Delivery time 9am to 6pm</span>
        </strong>
    </a>
   
    <span class="gap mx-4 d-none d-lg-block">|</span>
    <div class="d-none d-lg-block">
        <a href="tel:{{ $ws->contact_mobile }}" class="btn rounded my-1 py-1 text-center d-block text-white w3-deep-orange w3-small">
        Call For Order
        <i class="icon-phone-2"></i>&nbsp;{{ $ws->contact_mobile }}</a>
    </div>
</div><!-- End .header-right -->
     
   



