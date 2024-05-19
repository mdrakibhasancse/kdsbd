 <a href="{{ route('location', ['location-modal-open']) }}" class="btn w3-light-gray rounded my-1 py-1 text-center location-modal-lg">
    {{-- <i class="sicon-location-pin"></i><strong> --}}
    <i class="fa fa-map-marker-alt w3-text-indigo"></i>
{{ request()->cookie('area_name') ?? 'select area'}}</strong></a>