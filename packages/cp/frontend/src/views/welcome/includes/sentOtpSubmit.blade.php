<form method="post" action="{{ route('sendOtpMatchUser')}}" class="">
 @csrf
<div class="row">
    <div class="col-12"> 
        <div class="card">
            <div class="card-body">
            <div class="form-group">
                <label  for="mobile">Name</label>
                <input type="text" id="name" name="name" class="form-control "value="{{ old('name')}}" placeholder="Enter name">
            </div>

                
            <button type="submit" class="btn btn-sm btn-block btn-primary btn-first-next py-3">{{ __('Submit') }}</button>
            </div>
        </div>
    </div>
</div>
<form>