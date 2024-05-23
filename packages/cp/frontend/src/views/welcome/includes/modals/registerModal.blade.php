@push('css')

@endpush

<div id="modal_register" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content border-0"  style="background:rgba(0, 0, 0, .4);">
    <div class="modal-header bg-success border-0" style="height: 60px;">
      <h5 class="modal-title w3-text-white"><i class="far fa-user-circle"></i> {{ __('Sign in') }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
      <span aria-hidden="true" style="color: #fff">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      @if ($value =  request()->cookie('mobile_saved'))
        <form method="post" action="{{ route('sendOtpMatch')}}" class="sendOtpMatch">
          @csrf
        <div class="row">
          <div class="col-md-6 offset-md-3"> 
              <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                        <label  for="mobile">Otp Code</label>
                        <input type="text" id="code" name="code" class="form-control w3-medium" value="{{ old('code')}}" placeholder="Enter code">
                    </div>
                    <button type="submit" class="btn w3-medium btn-block btn-primary btn-first-next py-3">{{ __('Check Otp') }}</button>
                  </div>
              </div>
          </div>
        </div>
        <form>
        
        <div class="row ">
          <div class="col-12">
            <div class="sendOtpMatchData">
               {{-- @include('frontend::welcome.includes.sentOtpSubmit') --}}
            </div>
          </div>
        </div>
     

      @else
        <form method="post" action="{{ route('sendOtp')}}" class="mobile-check-form" id="mobile-create-form">
            @csrf
            <div class="row">
            <div class="col-md-6 offset-md-3"> 
                <div class="card">
                    <div class="card-body">
                    
                      <div class="form-group">
                          <label  for="mobile">Mobile</label>
                          <input type="text" id="mobile" name="mobile"  class="form-control input-mobile @error('mobile') is-invalid @enderror w3-medium" value="{{ old('mobile')}}" placeholder="Enter Mobile">
                          <span class="error_validation text-danger"></span>

                          @error('mobile')
                            <span class="text-danger">{{ $message}}</span> 
                          @enderror

                      </div>

                      <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}">


                        
                    <button type="submit" class="btn w3-medium btn-block btn-primary btn-first-next py-3">{{ __('Next') }}</button>
                    </div>
                </div>
            </div>
            </div>
        </form>
      @endif

    </div> 
    </div>
  </div> 
</div> 




