<a class="btn w3-light-gray rounded my-1 py-1 text-center" data-target="#myModalLg"  data-toggle="modal" >
    <strong><i class="fa fa-map-marker-alt w3-text-indigo"></i>
     {{ request()->cookie('area_name') ?? 'select area'}}</strong>
</a>