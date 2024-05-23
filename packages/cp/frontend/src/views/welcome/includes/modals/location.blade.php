 <div class="modal-content border-0" style="background:rgba(0, 0, 0, .4);"> 
    <div class="modal-header border-0" style="height: 60px; background: #0438A8">
      <h5 class="modal-title w3-text-white"><i class="fas fa-shipping-fast"></i> &nbsp;{{ __('Select Delivery Area') }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
      <span aria-hidden="true" style="color: white">&times;</span>
      </button>
    </div>      
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center justify-content-center">
                            <img  src="{{ route('imagecache', ['template' => 'cpxxxs', 'filename' => $ws->logo_alt()]) }}" alt="" style="display: inline-block;">
                        

                            <h2 class="mt-2 mb-2 w3-large w3-text-green font-weight-bold">Select Delivery Area</h2>
                            <form class="mb-0" action="#">
                                <div class="form-group">
                                    <select name="area" id="area" class="form-control select2 areaChange" data-url = "{{ route('areaChange')}}">
                                        <option value="">Select Delivery Area</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" {{ request()->cookie('area_name') == $area->name_en ? 'selected' : ''}}>{{ $area->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>