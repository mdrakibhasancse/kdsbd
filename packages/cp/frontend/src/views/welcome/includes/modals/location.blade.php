 <div class="modal-content w3-round w3-border w3-border-green">       
    <div class="modal-body" style="min-height: 250px;">
        <div class="card-">
            <div class="card-header-">
                <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="card-body pt-5 pb-0">
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

            

            <div class="modal-feed">
                {{-- <i class="fas fa-2x fa-sync-alt fa-spin w3-xxxlarge w3-text-blue"></i> --}}
            </div>
        </div>

    </div>
</div>